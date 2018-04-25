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
     * Delete method
     *
     * @param string|null $id Detalle Ubicacione id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $detalleUbicacion = $this->DetalleUbicaciones->get($id);
        if ($this->DetalleUbicaciones->delete($detalleUbicacion)) {
            $code = 200;
            $message = 'El detalle de ubicacion fue guardado correctamente';
        } else {
            $message = 'El detalle de ubicacion no fue guardado correctamente';
        }

        $this->set(compact('code', 'message'));
        $this->set('_serialize', ['code', 'message']);
    }
}
