<?php
namespace App\Controller;

use App\Controller\AppController;
use rabp9\CsvImporter;
require_once(ROOT . DS . 'vendor' . DS . 'rabp9' . DS . 'CsvImporter.php');
/**
 * Accidentes Controller
 *
 * @property \App\Model\Table\AccidentesTable $Accidentes
 */
class AccidentesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Ubicaciones', 'Causas', 'Estados']
        ];
        $accidentes = $this->paginate($this->Accidentes);

        $this->set(compact('accidentes'));
        $this->set('_serialize', ['accidentes']);
    }

    /**
     * View method
     *
     * @param string|null $id Accidente id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accidente = $this->Accidentes->get($id, [
            'contain' => ['Ubicaciones', 'Causas', 'Estados']
        ]);

        $this->set('accidente', $accidente);
        $this->set('_serialize', ['accidente']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $accidente = $this->Accidentes->newEntity();
        if ($this->request->is('post')) {
            $accidente = $this->Accidentes->patchEntity($accidente, $this->request->data);
            if ($this->Accidentes->save($accidente)) {
                $this->Flash->success(__('The accidente has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accidente could not be saved. Please, try again.'));
        }
        $ubicaciones = $this->Accidentes->Ubicaciones->find('list', ['limit' => 200]);
        $causas = $this->Accidentes->Causas->find('list', ['limit' => 200]);
        $estados = $this->Accidentes->Estados->find('list', ['limit' => 200]);
        $this->set(compact('accidente', 'ubicaciones', 'causas', 'estados'));
        $this->set('_serialize', ['accidente']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Accidente id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $accidente = $this->Accidentes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accidente = $this->Accidentes->patchEntity($accidente, $this->request->data);
            if ($this->Accidentes->save($accidente)) {
                $this->Flash->success(__('The accidente has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accidente could not be saved. Please, try again.'));
        }
        $ubicaciones = $this->Accidentes->Ubicaciones->find('list', ['limit' => 200]);
        $causas = $this->Accidentes->Causas->find('list', ['limit' => 200]);
        $estados = $this->Accidentes->Estados->find('list', ['limit' => 200]);
        $this->set(compact('accidente', 'ubicaciones', 'causas', 'estados'));
        $this->set('_serialize', ['accidente']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Accidente id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $accidente = $this->Accidentes->get($id);
        if ($this->Accidentes->delete($accidente)) {
            $this->Flash->success(__('The accidente has been deleted.'));
        } else {
            $this->Flash->error(__('The accidente could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function load() {
        $this->viewBuilder()->layout(false);
        if ($this->request->is("post")) {
            $csv = $this->request->data["file"];
            
            $importer = new CsvImporter($csv["tmp_name"], true, ';');
            $accidentes = $importer->get();
            
            foreach ($accidentes as $k_accidente => $accidente) {
                // Ubicaciones
                $ubicacion_text = $accidente['ubicacion'];
                
                $detalleUbicacion = $this->Accidentes->Ubicaciones->DetalleUbicaciones->find()
                    ->contain(["Ubicaciones"])
                    ->where(['DetalleUbicaciones.descripcion' => $ubicacion_text])
                    ->first();
                
                if (is_null($detalleUbicacion)) {
                    $accidentes[$k_accidente]['ubicacion_text'] = $accidente['ubicacion'];
                    $accidentes[$k_accidente]['ubicacion'] = null;
                } else {
                    $accidentes[$k_accidente]['ubicacion_text'] = $detalleUbicacion->ubicacion->descripcion;
                    $accidentes[$k_accidente]['ubicacion'] = $detalleUbicacion->ubicacion;
                }
                
                // Causas
                $causa_text = $accidente['causa'];
                
                $detalleCausa = $this->Accidentes->Causas->DetalleCausas->find()
                    ->contain(["Causas"])
                    ->where(['DetalleCausas.descripcion' => $causa_text])
                    ->first();
                
                if (is_null($detalleCausa)) {
                    $accidentes[$k_accidente]['causa_text'] = $accidente['causa'];
                    $accidentes[$k_accidente]['causa'] = null;
                } else {
                    $accidentes[$k_accidente]['causa_text'] = $detalleCausa->causa->descripcion;
                    $accidentes[$k_accidente]['causa'] = $detalleCausa->causa;
                }
            }
            
            $this->set(compact("accidentes"));
            $this->set("_serialize", ["accidentes"]);
        }
    }
}
