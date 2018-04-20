<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
/**
 * DetalleAccidentes Controller
 *
 * @property \App\Model\Table\DetalleAccidentesTable $DetalleAccidentes
 */
class DetalleAccidentesController extends AppController
{
    /**
     * Delete method
     *
     * @param string|null $id Accidente id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $detalleAccidente = $this->DetalleAccidentes->get($id);
        if ($this->DetalleAccidentes->delete($detalleAccidente)) {
            $code = 200;
            $message = 'El detalle de accidente fue guardado correctamente';
        } else {
            $message = 'El detalle de accidente no fue guardado correctamente';
        }
        
        $this->set(compact('code', 'message'));
        $this->set('_serialize', ['code', 'message']);
    }
}
