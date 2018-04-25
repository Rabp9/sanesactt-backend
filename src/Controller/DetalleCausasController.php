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
     * Delete method
     *
     * @param string|null $id Detalle Causa id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $detalleCausa = $this->DetalleCausas->get($id);
        if ($this->DetalleCausas->delete($detalleCausa)) {
            $code = 200;
            $message = 'El detalle de causa fue guardado correctamente';
        } else {
            $message = 'El detalle de causa no fue guardado correctamente';
        }

        $this->set(compact('code', 'message'));
        $this->set('_serialize', ['code', 'message']);
    }
}
