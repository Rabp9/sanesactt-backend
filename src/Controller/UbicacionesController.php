<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ubicaciones Controller
 *
 * @property \App\Model\Table\UbicacionesTable $Ubicaciones
 */
class UbicacionesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Estados']
        ];
        $ubicaciones = $this->paginate($this->Ubicaciones);

        $this->set(compact('ubicaciones'));
        $this->set('_serialize', ['ubicaciones']);
    }

    /**
     * View method
     *
     * @param string|null $id Ubicacione id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $ubicacione = $this->Ubicaciones->get($id, [
            'contain' => ['Estados']
        ]);

        $this->set('ubicacione', $ubicacione);
        $this->set('_serialize', ['ubicacione']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->viewBuilder()->layout(false);
        $ubicacion = $this->Ubicaciones->newEntity();
        $ubicacion->estado_id = 1;
        if ($this->request->is('post')) {
            $ubicacion = $this->Ubicaciones->patchEntity($ubicacion, $this->request->data);
            if ($this->Ubicaciones->save($ubicacion)) {
                $message =  [
                    'text' => __('La Ubicación fue registrada correctamente'),
                    'type' => 'success',
                ];
            } else {
                $message =  [
                    'text' => __('La Ubicación no fue registrada correctamente'),
                    'type' => 'error',
                ];
            }
        }
        $this->set(compact('ubicacion', 'message'));
        $this->set('_serialize', ['ubicacion', 'message']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ubicacione id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $ubicacione = $this->Ubicaciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ubicacione = $this->Ubicaciones->patchEntity($ubicacione, $this->request->data);
            if ($this->Ubicaciones->save($ubicacione)) {
                $this->Flash->success(__('The ubicacione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ubicacione could not be saved. Please, try again.'));
        }
        $estados = $this->Ubicaciones->Estados->find('list', ['limit' => 200]);
        $this->set(compact('ubicacione', 'estados'));
        $this->set('_serialize', ['ubicacione']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ubicacione id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $ubicacione = $this->Ubicaciones->get($id);
        if ($this->Ubicaciones->delete($ubicacione)) {
            $this->Flash->success(__('The ubicacione has been deleted.'));
        } else {
            $this->Flash->error(__('The ubicacione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * Buscar method
     *
     * @param string $texto
     * @return \Cake\Network\Response|null
     */
    public function buscar($texto = null) { 
        $this->viewBuilder()->layout(false);
        
        $texto = $this->request->param("texto");
        
        $detalleUbicacion = $this->Ubicaciones->DetalleUbicaciones->find()
            ->contain(["Ubicaciones"])
            ->where(['DetalleUbicaciones.descripcion' => $texto])
            ->first();
        
        $ubicacion = !empty($detalleUbicacion) ? $detalleUbicacion->ubicacion : null;
        
        $this->set(compact('ubicacion'));
        $this->set('_serialize', ['ubicacion']);
    }
    
    /**
     * BuscarUbicaciones method
     *
     * @return \Cake\Network\Response|null
     */
    public function buscarUbicaciones() {
        $this->viewBuilder()->layout(false);
        
        $search = $this->request->data['search'];
        $pagenumber = $this->request->data['pagenumber'];
        
        $ubicaciones = $this->Ubicaciones->find('all')
            ->where(['Ubicaciones.descripcion like' => '%' . $search . '%'])
            ->select(['descripcion', 'id'])
            ->limit(10)
            ->page($pagenumber);
        
        $this->set(compact('ubicaciones'));
        
        if ($pagenumber == 1) {
            $TotalRecords = $this->Ubicaciones->find('all')
                ->where(['Ubicaciones.estado_id' => 1])
                ->count();
            
            $this->set(compact('TotalRecords'));
        }
        $this->set('_serialize', ['ubicaciones', 'TotalRecords']);
    }
      
    public function preview() {
        if ($this->request->is("post")) {
            $foto = $this->request->data["file"];
            
            $filename = $this->randomString();
            $url = WWW_ROOT . "tmp" . DS . $filename;
                        
            while (file_exists($url)) {
                $filename = $this->randomString();
                $url = WWW_ROOT . "tmp" . DS . $filename;
            }
            
            if (move_uploaded_file($foto["tmp_name"], $url)) {
                $message = [
                    "type" => "success",
                    "text" => "La foto fue subida con éxito"
                ];
            } else {
                $message = [
                    "type" => "error",
                    "text" => "La foto no fue subida con éxito",
                ];
            }
            
            $this->set(compact("message", "filename"));
            $this->set("_serialize", ["message", "filename"]);
        }
    }
    
    private function randomString($length = 8) {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }
}
