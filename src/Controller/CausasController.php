<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Causas Controller
 *
 * @property \App\Model\Table\CausasTable $Causas
 */
class CausasController extends AppController
{

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
        
        $query = $this->Causas->find()
            ->order(['Causas.id' => 'ASC']);
        
        if ($text) {
            $query->where(['Causas.descripcion LIKE' => '%' . $text . '%']);
        }
        
        if ($estado_1 == 'true') {
            array_push($estados, 1);
        }
        
        if ($estado_2 == 'true') {
            array_push($estados, 2);
        }
        
        if (!empty($estados)) {
            $query->where(['Causas.estado_id IN' => $estados]);
        }
        
        $causas = $this->paginate($query);
        $paginate = $this->request->param('paging')['Causas'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('causas', 'pagination'));
        $this->set('_serialize', ['causas', 'pagination']);
    }

    /**
     * View method
     *
     * @param string|null $id Causa id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $causa = $this->Causas->get($id, ['contain' => ['DetalleCausas']]);

        $this->set('causa', $causa);
        $this->set('_serialize', ['causa']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $causa = $this->Causas->newEntity();
        if ($this->request->is('post')) {
            $causa = $this->Causas->patchEntity($causa, $this->request->data);
            $causa->estado_id = 1;
            
            if ($this->Causas->save($causa)) {
                $code = 200;
                $message = 'La causa fue guardada correctamente';
            } else {
                $message = 'La causa no fue guardada correctamente';
            }
        }
        $this->set(compact('causa', 'code', 'message'));
        $this->set('_serialize', ['causa', 'code', 'message']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Causa id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $causa = $this->Causas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $causa = $this->Causas->patchEntity($causa, $this->request->data);
            if ($this->Causas->save($causa)) {
                $this->Flash->success(__('The causa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The causa could not be saved. Please, try again.'));
        }
        $estados = $this->Causas->Estados->find('list', ['limit' => 200]);
        $this->set(compact('causa', 'estados'));
        $this->set('_serialize', ['causa']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Causa id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $causa = $this->Causas->get($id);
        if ($this->Causas->delete($causa)) {
            $this->Flash->success(__('The causa has been deleted.'));
        } else {
            $this->Flash->error(__('The causa could not be deleted. Please, try again.'));
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
       
        $detalleCausa = $this->Causas->DetalleCausas->find()
            ->contain(["Causas"])
            ->where(['DetalleCausas.descripcion' => $texto])
            ->toArray();
        
        $causa = !empty($detalleCausa) ? $detalleCausa->causa : null;
        
        $this->set(compact('causa'));
        $this->set('_serialize', ['causa']);
    }
    
    /**
     * BuscarCausas method
     *
     * @return \Cake\Network\Response|null
     */
    public function buscarCausas() {
        $this->viewBuilder()->layout(false);
        
        $search = $this->request->data['search'];
        $pagenumber = $this->request->data['pagenumber'];
        
        $causas = $this->Causas->find('all')
            ->where(['Causas.descripcion like' => '%' . $search . '%'])
            ->select(['descripcion', 'id'])
            ->limit(10)
            ->page($pagenumber);
        
        $this->set(compact('causas'));
        
        if ($pagenumber == 1) {
            $TotalRecords = $this->Causas->find('all')
                ->where(['Causas.estado_id' => 1])
                ->count();
            
            $this->set(compact('TotalRecords'));
        }
        $this->set('_serialize', ['causas', 'TotalRecords']);
    }
        
}