<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TipoVehiculos Controller
 *
 * @property \App\Model\Table\TipoVehiculosTable $TipoVehiculos
 */
class TipoVehiculosController extends AppController
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
        $tipo_vehiculos = $this->paginate($this->TipoVehiculos);

        $this->set(compact('tipo_vehiculos'));
        $this->set('_serialize', ['tipo_vehiculos']);
    }

    /**
     * View method
     *
     * @param string|null $id Tipo Vehiculo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $tipo_vehiculo = $this->TipoVehiculos->get($id);

        $this->set('tipo_vehiculo', $tipo_vehiculo);
        $this->set('_serialize', ['tipo_vehiculo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $tipo_vehiculo = $this->TipoVehiculos->newEntity();

        if ($this->request->is('post')) {
            $tipo_vehiculo = $this->TipoVehiculos->patchEntity($tipo_vehiculo, $this->request->data);
            
            if ($this->TipoVehiculos->save($tipo_vehiculo)) {
                $code = 200;
                $message = 'El Tipo de Vehículo fue guardado correctamente';
            } else {
                $message = 'El Tipo de Vehículo no fue guardado correctamente';
            }
        }
        $this->set(compact('tipo_vehiculo', 'code', 'message'));
        $this->set('_serialize', ['tipo_vehiculo', 'code', 'message']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tipo Vehiculo id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tipoVehiculo = $this->TipoVehiculos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tipoVehiculo = $this->TipoVehiculos->patchEntity($tipoVehiculo, $this->request->data);
            if ($this->TipoVehiculos->save($tipoVehiculo)) {
                $this->Flash->success(__('The tipo vehiculo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo vehiculo could not be saved. Please, try again.'));
        }
        $estados = $this->TipoVehiculos->Estados->find('list', ['limit' => 200]);
        $this->set(compact('tipoVehiculo', 'estados'));
        $this->set('_serialize', ['tipoVehiculo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tipo Vehiculo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tipoVehiculo = $this->TipoVehiculos->get($id);
        if ($this->TipoVehiculos->delete($tipoVehiculo)) {
            $this->Flash->success(__('The tipo vehiculo has been deleted.'));
        } else {
            $this->Flash->error(__('The tipo vehiculo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
