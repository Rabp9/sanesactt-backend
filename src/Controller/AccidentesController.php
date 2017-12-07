<?php
namespace App\Controller;

use App\Controller\AppController;
use rabp9\CsvImporter;
require_once(ROOT . DS . 'vendor' . DS . 'rabp9' . DS . 'CsvImporter.php');
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
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
    public function index() {
        $accidentes = $this->Accidentes->find()
            ->where(['estado_id IN' => [1, 3]]);

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
    public function getByNroIdNAnio() {
        $nro_id = $this->request->query('nro_id');
        $anio = $this->request->query('anio');
        
        $accidente = $this->Accidentes->find()
            ->contain(['DetalleAccidentes'])
            ->where([
                'nro_id' => $nro_id,
                'anio' => $anio
            ])
            ->first();
        
        $this->set(compact('accidente'));
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
            
            $i = 1;
            foreach ($accidentes as $k_accidente => $accidente) {
                $accidentes[$k_accidente]['id'] = $i;
                $i++;
            }
            
            $this->set(compact("accidentes"));
            $this->set("_serialize", ["accidentes"]);
        }
    }
    
    public function saveMany() {
        $this->viewBuilder()->layout(false);
        if ($this->request->is('post')) {
            $accidentes = $this->Accidentes->newEntities($this->request->data);
            $conn = ConnectionManager::get('default');
            $conn->begin();
            $saveStatus = 1;
            foreach ($accidentes as $accidente) {
                $accidente->fecha = new FrozenDate($accidente->fecha);
                $accidente->anio = $accidente->fecha->year;
                $accidente->fechaHora = new FrozenTime($accidente->fecha . ' ' . $accidente->hora);
                $accidente->estado_id = 3;
                
                if(!$this->Accidentes->save($accidente))  {
                    $saveStatus = 0;
                }
            }
            if ($saveStatus) {
                $conn->commit();
                $message =  [
                    'text' => __('Los asccidentes fueron guardados correctamente'),
                    'type' => 'success',
                ];
            } else {
                $conn->rollback();
                $message =  [
                    'text' => __('Los asccidentes no fueron guardados correctamente'),
                    'type' => 'error',
                ];
            }
        }
        
        $this->set(compact('message', 'accidentes'));
        $this->set("_serialize", ['message']);
    }
}
