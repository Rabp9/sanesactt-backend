<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\File;
/**
 * Ubicaciones Controller
 *
 * @property \App\Model\Table\UbicacionesTable $Ubicaciones
 */
class UbicacionesController extends AppController
{
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['puntosNegros']);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $estado_1 = $this->request->query('estado_1');
        $estado_2 = $this->request->query('estado_2');
        $estados = [];
        $text = $this->request->query('text');
        $items_per_page = $this->request->query('items_per_page');
        
        $this->paginate = [
            'limit' => $items_per_page
        ];
        
        $query = $this->Ubicaciones->find()
            ->order(['Ubicaciones.id' => 'ASC']);
        
        if ($text) {
            $query->where(['Ubicaciones.descripcion LIKE' => '%' . $text . '%']);
        }
        
        if ($estado_1 == 'true') {
            array_push($estados, 1);
        }
        
        if ($estado_2 == 'true') {
            array_push($estados, 2);
        }
        
        if (!empty($estados)) {
            $query->where(['Ubicaciones.estado_id IN' => $estados]);
        }
        
        $ubicaciones = $this->paginate($query);
        $paginate = $this->request->param('paging')['Ubicaciones'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('ubicaciones', 'pagination'));
        $this->set('_serialize', ['ubicaciones', 'pagination']);
    }

    /**
     * View method
     *
     * @param string|null $id Ubicacione id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $ubicacion = $this->Ubicaciones->get($id, ['contain' => ['DetalleUbicaciones']]);

        $this->set('ubicacion', $ubicacion);
        $this->set('_serialize', ['ubicacion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $ubicacion = $this->Ubicaciones->newEntity();
        if ($this->request->is('post')) {
            $ubicacion = $this->Ubicaciones->patchEntity($ubicacion, $this->request->data);
            
            if ($ubicacion->foto) {
                $path_src = WWW_ROOT . "tmp" . DS;
                $file_tmp = new File($path_src . $ubicacion->foto);

                $path_dst = WWW_ROOT . 'img' . DS . 'ubicaciones' . DS;
                $ubicacion->foto = $this->Random->randomFileName($path_dst, 'ubicacion-');

                if ($file_tmp->copy($path_dst . $ubicacion->foto)) {
                    if ($this->Ubicaciones->save($ubicacion)) {
                        $code = 200;
                        $message = 'La ubicación fue guardada correctamente';
                    } else {
                        $message = 'La ubicación no fue guardada correctamente';
                    }
                } else {
                    $message = 'La ubicación no fue guardada correctamente';
                }
            } else {
                if ($this->Ubicaciones->save($ubicacion)) {
                    $code = 200;
                    $message = 'La ubicación fue guardada correctamente';
                } else {
                    $message = 'La ubicación no fue guardada correctamente';
                }
            }
        }
        $this->set(compact('ubicacion', 'code', 'message'));
        $this->set('_serialize', ['ubicacion', 'code', 'message']);
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
            $path = WWW_ROOT . "tmp" . DS;
            $file = $this->request->data["file"];
            
            $foto = new File($file["tmp_name"]);
            $filename = $this->Random->randomFileName($path);
            
            if ($foto->copy($path . $filename)) {
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
    
    /*
     * Get Puntos Negros method
     *
     * @return \Cake\Network\Response|null
     */
    public function getPuntosNegros() {
        $limite = $this->request->query('limite');
        $fecha_inicio = $this->request->query('fecha_inicio');
        $fecha_cierre = $this->request->query('fecha_cierre');
        
        $query = $this->Ubicaciones->find();
        
        $query->select(['Ubicaciones.id', 'Ubicaciones.descripcion', 'Ubicaciones.longitud', 'Ubicaciones.latitud', 'total' => $query->func()->count('Accidentes.id')])
            ->leftJoinWith('Accidentes')
            ->group(['Ubicaciones.id', 'Ubicaciones.descripcion', 'Ubicaciones.longitud', 'Ubicaciones.latitud'])
            ->where(function($exp) use ($fecha_inicio, $fecha_cierre) {
                return $exp->between('Accidentes.fechaHora', $fecha_inicio, $fecha_cierre, 'date');
            })
            ->leftJoinWith('Accidentes')
            ->having(['total >=' => $limite])
            ->group(['Ubicaciones.id', 'Ubicaciones.descripcion', 'Ubicaciones.longitud', 'Ubicaciones.latitud']);
        $ubicaciones = $query->toArray();
        
        $this->set(compact('ubicaciones'));
        $this->set('_serialize', ['ubicaciones']);
    }

    public function puntosNegros() {
    }
}
