<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DetalleUbicaciones Controller
 *
 * @property \App\Model\Table\DetalleUbicacionesTable $DetalleUbicaciones
 */
class DetalleUbicacionesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Ubicaciones', 'Estados']
        ];
        $detalleUbicaciones = $this->paginate($this->DetalleUbicaciones);

        $this->set(compact('detalleUbicaciones'));
        $this->set('_serialize', ['detalleUbicaciones']);
    }

    /**
     * View method
     *
     * @param string|null $id Detalle Ubicacione id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $detalleUbicacione = $this->DetalleUbicaciones->get($id, [
            'contain' => ['Ubicaciones', 'Estados']
        ]);

        $this->set('detalleUbicacione', $detalleUbicacione);
        $this->set('_serialize', ['detalleUbicacione']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $detalleUbicacione = $this->DetalleUbicaciones->newEntity();
        if ($this->request->is('post')) {
            $detalleUbicacione = $this->DetalleUbicaciones->patchEntity($detalleUbicacione, $this->request->data);
            if ($this->DetalleUbicaciones->save($detalleUbicacione)) {
                $this->Flash->success(__('The detalle ubicacione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The detalle ubicacione could not be saved. Please, try again.'));
        }
        $ubicaciones = $this->DetalleUbicaciones->Ubicaciones->find('list', ['limit' => 200]);
        $estados = $this->DetalleUbicaciones->Estados->find('list', ['limit' => 200]);
        $this->set(compact('detalleUbicacione', 'ubicaciones', 'estados'));
        $this->set('_serialize', ['detalleUbicacione']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Detalle Ubicacione id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $detalleUbicacione = $this->DetalleUbicaciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $detalleUbicacione = $this->DetalleUbicaciones->patchEntity($detalleUbicacione, $this->request->data);
            if ($this->DetalleUbicaciones->save($detalleUbicacione)) {
                $this->Flash->success(__('The detalle ubicacione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The detalle ubicacione could not be saved. Please, try again.'));
        }
        $ubicaciones = $this->DetalleUbicaciones->Ubicaciones->find('list', ['limit' => 200]);
        $estados = $this->DetalleUbicaciones->Estados->find('list', ['limit' => 200]);
        $this->set(compact('detalleUbicacione', 'ubicaciones', 'estados'));
        $this->set('_serialize', ['detalleUbicacione']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Detalle Ubicacione id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $detalleUbicacione = $this->DetalleUbicaciones->get($id);
        if ($this->DetalleUbicaciones->delete($detalleUbicacione)) {
            $this->Flash->success(__('The detalle ubicacione has been deleted.'));
        } else {
            $this->Flash->error(__('The detalle ubicacione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
