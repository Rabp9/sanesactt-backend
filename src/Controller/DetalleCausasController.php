<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DetalleCausas Controller
 *
 * @property \App\Model\Table\DetalleCausasTable $DetalleCausas
 */
class DetalleCausasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Causas', 'Estados']
        ];
        $detalleCausas = $this->paginate($this->DetalleCausas);

        $this->set(compact('detalleCausas'));
        $this->set('_serialize', ['detalleCausas']);
    }

    /**
     * View method
     *
     * @param string|null $id Detalle Causa id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $detalleCausa = $this->DetalleCausas->get($id, [
            'contain' => ['Causas', 'Estados']
        ]);

        $this->set('detalleCausa', $detalleCausa);
        $this->set('_serialize', ['detalleCausa']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $detalleCausa = $this->DetalleCausas->newEntity();
        if ($this->request->is('post')) {
            $detalleCausa = $this->DetalleCausas->patchEntity($detalleCausa, $this->request->data);
            if ($this->DetalleCausas->save($detalleCausa)) {
                $this->Flash->success(__('The detalle causa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The detalle causa could not be saved. Please, try again.'));
        }
        $causas = $this->DetalleCausas->Causas->find('list', ['limit' => 200]);
        $estados = $this->DetalleCausas->Estados->find('list', ['limit' => 200]);
        $this->set(compact('detalleCausa', 'causas', 'estados'));
        $this->set('_serialize', ['detalleCausa']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Detalle Causa id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $detalleCausa = $this->DetalleCausas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $detalleCausa = $this->DetalleCausas->patchEntity($detalleCausa, $this->request->data);
            if ($this->DetalleCausas->save($detalleCausa)) {
                $this->Flash->success(__('The detalle causa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The detalle causa could not be saved. Please, try again.'));
        }
        $causas = $this->DetalleCausas->Causas->find('list', ['limit' => 200]);
        $estados = $this->DetalleCausas->Estados->find('list', ['limit' => 200]);
        $this->set(compact('detalleCausa', 'causas', 'estados'));
        $this->set('_serialize', ['detalleCausa']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Detalle Causa id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $detalleCausa = $this->DetalleCausas->get($id);
        if ($this->DetalleCausas->delete($detalleCausa)) {
            $this->Flash->success(__('The detalle causa has been deleted.'));
        } else {
            $this->Flash->error(__('The detalle causa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
