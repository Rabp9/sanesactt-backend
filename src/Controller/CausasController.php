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
        $this->paginate = [
            'contain' => ['Estados']
        ];
        $causas = $this->paginate($this->Causas);

        $this->set(compact('causas'));
        $this->set('_serialize', ['causas']);
    }

    /**
     * View method
     *
     * @param string|null $id Causa id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $causa = $this->Causas->get($id, [
            'contain' => ['Estados']
        ]);

        $this->set('causa', $causa);
        $this->set('_serialize', ['causa']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->viewBuilder()->layout(false);
        $causa = $this->Causas->newEntity();
        $causa->estado_id = 1;
        if ($this->request->is('post')) {
            $causa = $this->Causas->patchEntity($causa, $this->request->data);
            if ($this->Causas->save($causa)) {
                $message =  [
                    'text' => __('La Causa fue registrada correctamente'),
                    'type' => 'success',
                ];
            } else {
                $message =  [
                    'text' => __('La Causa no fue registrada correctamente'),
                    'type' => 'error',
                ];
            }
        }
        $this->set(compact('causa', 'message'));
        $this->set('_serialize', ['causa', 'message']);
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