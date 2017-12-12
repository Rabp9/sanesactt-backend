<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TipoServicios Controller
 *
 * @property \App\Model\Table\TipoServiciosTable $TipoServicios
 */
class TipoServiciosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Estados']
        ];
        $tipo_servicios = $this->paginate($this->TipoServicios);

        $this->set(compact('tipo_servicios'));
        $this->set('_serialize', ['tipo_servicios']);
    }

    /**
     * View method
     *
     * @param string|null $id Tipo Servicio id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $tipo_servicio = $this->TipoServicios->get($id);

        $this->set('tipo_servicio', $tipo_servicio);
        $this->set('_serialize', ['tipo_servicio']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $tipo_servicio = $this->TipoServicios->newEntity();

        if ($this->request->is('post')) {
            $tipo_servicio = $this->TipoServicios->patchEntity($tipo_servicio, $this->request->data);
            
            if ($this->TipoServicios->save($tipo_servicio)) {
                $code = 200;
                $message = 'El Tipo de Servicio fue guardado correctamente';
            } else {
                $message = 'El Tipo de Servicio no fue guardado correctamente';
            }
        }
        $this->set(compact('tipo_servicio', 'code', 'message'));
        $this->set('_serialize', ['tipo_servicio', 'code', 'message']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tipo Servicio id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tipoServicio = $this->TipoServicios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tipoServicio = $this->TipoServicios->patchEntity($tipoServicio, $this->request->data);
            if ($this->TipoServicios->save($tipoServicio)) {
                $this->Flash->success(__('The tipo servicio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo servicio could not be saved. Please, try again.'));
        }
        $estados = $this->TipoServicios->Estados->find('list', ['limit' => 200]);
        $this->set(compact('tipoServicio', 'estados'));
        $this->set('_serialize', ['tipoServicio']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tipo Servicio id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tipoServicio = $this->TipoServicios->get($id);
        if ($this->TipoServicios->delete($tipoServicio)) {
            $this->Flash->success(__('The tipo servicio has been deleted.'));
        } else {
            $this->Flash->error(__('The tipo servicio could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
