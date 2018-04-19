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
        $estado_1 = $this->request->query('estado_1');
        $estado_2 = $this->request->query('estado_2');
        $estado_3 = $this->request->query('estado_3');
        $estado_4 = $this->request->query('estado_4');
        $estados = [];
        $text = $this->request->query('text');
        $items_per_page = $this->request->query('items_per_page');
        
        $this->paginate = [
            'limit' => $items_per_page
        ];
        
        $query = $this->Accidentes->find()
            ->contain(['Ubicaciones', 'Causas'])
            ->order(['Accidentes.id' => 'ASC']);
        
        if ($text) {
            $query->where(['OR' => [
                'Accidentes.ubicacion_dirty LIKE' => '%' . $text . '%',
                'Accidentes.causa_dirty LIKE' => '%' . $text . '%',
                'Ubicaciones.descripcion LIKE' => '%' . $text . '%',
                'Causas.descripcion LIKE' => '%' . $text . '%'
            ]]);
        }
        
        if ($estado_1 == 'true') {
            array_push($estados, 1);
        }
        
        if ($estado_2 == 'true') {
            array_push($estados, 2);
        }
        
        if ($estado_3 == 'true') {
            array_push($estados, 3);
        }
        
        if ($estado_4 == 'true') {
            array_push($estados, 4);
        }
        
        if (!empty($estados)) {
            $query->where(['Accidentes.estado_id IN' => $estados]);
        }
        
        $accidentes = $this->paginate($query);
        $paginate = $this->request->param('paging')['Accidentes'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('accidentes', 'pagination'));
        $this->set('_serialize', ['accidentes', 'pagination']);
    }

    /**
     * View method
     *
     * @param string|null $id Accidente id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $accidente = $this->Accidentes->get($id, [
            'contain' => ['DetalleAccidentes' => ['TipoVehiculos', 'TipoServicios']]
        ]);

        $this->set(compact('accidente'));
        $this->set('_serialize', ['accidente']);
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
    public function add() {
        $accidente = $this->Accidentes->newEntity();
        if ($this->request->is('post')) {
            $accidente = $this->Accidentes->patchEntity($accidente, $this->request->data);
            if ($accidente->estado_id == 3 && $accidente->ubicacion_id != null && $accidente->causa_id != null) {
                $accidente->estado_id = 4;
            }
            if ($this->Accidentes->save($accidente)) {
                $code = 200;
                $message = 'El accidente fue guardado correctamente';
            } else {
                $message = 'El accidente no fue guardado correctamente';
            }
        }
        $this->set(compact('accidente', 'code', 'message'));
        $this->set('_serialize', ['accidente', 'code', 'message']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Accidente id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
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
                $fecha = new FrozenDate($accidente->fecha);
                $accidente->anio = $fecha->year;
                $accidente->fechaHora = new FrozenTime($fecha . ' ' . $accidente->hora);
                $accidente->estado_id = 3; // sin procesar
                
                if(!$this->Accidentes->save($accidente))  {
                    $saveStatus = 0;
                }
            }
            if ($saveStatus) {
                $conn->commit();
                $code = 200;
                $message = 'Los asccidentes fueron guardados correctamente';
            } else {
                $conn->rollback();
                $message = 'Los asccidentes no fueron guardados correctamente';
            }
        }
        
        $this->set(compact('message', 'accidentes', 'code'));
        $this->set("_serialize", ['message', 'accidentes', 'code']);
    }
}
