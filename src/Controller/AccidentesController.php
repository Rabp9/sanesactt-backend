<?php
namespace App\Controller;

use App\Controller\AppController;
use rabp9\CsvImporter;
require_once(ROOT . DS . 'vendor' . DS . 'rabp9' . DS . 'CsvImporter.php');
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Hash;
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
            if (!$accidente->id) {
                $accidente->estado_id = 1;
            }
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
                
                if ($accidente->ubicacion_dirty != "") {
                    $detalleUbicacion =  $this->Accidentes->Ubicaciones->DetalleUbicaciones->find()
                        ->contain(['Ubicaciones'])
                        ->where(['DetalleUbicaciones.descripcion' => $accidente->ubicacion_dirty])->first();
                    if ($detalleUbicacion != null) {
                        $accidente->ubicacion_id = $detalleUbicacion->ubicacion->id;
                    }
                }
                
                if ($accidente->causa_dirty != "") {
                    $detalleCausa =  $this->Accidentes->Causas->DetalleCausas->find()
                        ->contain(['Causas'])
                        ->where(['DetalleCausas.descripcion' => $accidente->causa_dirty])->first();
                    if ($detalleCausa != null) {
                        $accidente->causa_id = $detalleCausa->causa->id;
                    }
                }
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
    
    public function getReportAnual() {
        $fechaCierre = $this->request->getData('fechaCierre');
        $ubicacion_id = $this->request->getData('ubicacion_id');
        
        $fecha = new FrozenDate($fechaCierre);
        $year = $fecha->year;
        
        $labels = [];
        $datos = [];
        for ($i = $year - 4; $i <= $year; $i++) {
            $labels[] = $i;
            $datos[] = $this->Accidentes->find()
                ->where([
                    'YEAR(fechaHora)' => $i,
                    'ubicacion_id' => $ubicacion_id,
                    'estado_id !=' => 2
                ])->count();
        }
        
        $this->set(compact('labels', 'datos'));
        $this->set("_serialize", ['labels', 'datos']);
    }
    
    public function getReportMensual() {
        $fechaInicio = $this->request->getData('fechaInicio');
        $fechaCierre = $this->request->getData('fechaCierre');
        $ubicacion_id = $this->request->getData('ubicacion_id');
        
        $fechaInicioFD = new FrozenDate($fechaInicio);
        $fechaCierreFD = new FrozenDate($fechaCierre);
        
        $labels = [];
        $datos = [];
        
        while ($fechaInicioFD != $fechaCierreFD) {
            $fechaInicioFD = $fechaInicioFD->addMonth();
            $labels[] = $fechaInicioFD->i18nFormat('MMM') . "-" . $fechaInicioFD->year;
            
            $datos[] = $this->Accidentes->find()
                ->where([
                    'MONTH(fechaHora)' => $fechaInicioFD->i18nFormat('MM'),
                    'YEAR(fechaHora)' => $fechaInicioFD->format('Y'),
                    'ubicacion_id' => $ubicacion_id,
                    'estado_id !=' => 2
                ])->count();
        }
        
        $this->set(compact('labels', 'datos'));
        $this->set("_serialize", ['labels', 'datos']);
    }
    
    public function getReportDiario() {
        $fechaInicio = $this->request->getData('fechaInicio');
        $fechaCierre = $this->request->getData('fechaCierre');
        $ubicacion_id = $this->request->getData('ubicacion_id');
        
        $labels = ['Dom.', 'Lun.', 'Mar.', 'Mié.', 'Jue.', 'Vie.', 'Sáb.'];
        for ($i = 1; $i <= sizeof($labels); $i++) {
            $datos[] = $this->Accidentes->find()
                ->where([
                    'fechaHora >' => $fechaInicio,
                    'fechaHora <=' => $fechaCierre,
                    'DAYOFWEEK(fechaHora)' => $i,
                    'ubicacion_id' => $ubicacion_id,
                    'estado_id !=' => 2
                ])->count();
        }
        
        $this->set(compact('labels', 'datos'));
        $this->set("_serialize", ['labels', 'datos']);
    }
    
    public function getReportServicios() {
        $fechaInicio = $this->request->getData('fechaInicio');
        $fechaCierre = $this->request->getData('fechaCierre');
        $ubicacion_id = $this->request->getData('ubicacion_id');
        
        $servicios = $this->Accidentes->DetalleAccidentes->TipoServicios->find()
            ->distinct(['descripcion'])->toArray();
        
        $labels = Hash::extract($servicios, '{n}.descripcion');
        
        foreach ($servicios as $servicio) {
            $datos[] = $this->Accidentes->find()
                ->matching('DetalleAccidentes', function($q) use($servicio) {
                    return $q->where(['DetalleAccidentes.tipo_servicio_id' => $servicio->id]);
                })
                ->where([
                    'fechaHora >' => $fechaInicio,
                    'fechaHora <=' => $fechaCierre,
                    'ubicacion_id' => $ubicacion_id,
                    'estado_id !=' => 2
                ])->count();
        }
        
        $this->set(compact('labels', 'datos'));
        $this->set("_serialize", ['labels', 'datos']);
    }
    
    public function getReportVehiculos() {
        $fechaInicio = $this->request->getData('fechaInicio');
        $fechaCierre = $this->request->getData('fechaCierre');
        $ubicacion_id = $this->request->getData('ubicacion_id');
        
        $servicios = $this->Accidentes->DetalleAccidentes->TipoVehiculos->find()
            ->distinct(['descripcion'])->toArray();
        
        $labels = Hash::extract($servicios, '{n}.descripcion');
        
        foreach ($servicios as $servicio) {
            $datos[] = $this->Accidentes->find()
                ->matching('DetalleAccidentes', function($q) use($servicio) {
                    return $q->where(['DetalleAccidentes.tipo_vehiculo_id' => $servicio->id]);
                })
                ->where([
                    'fechaHora >' => $fechaInicio,
                    'fechaHora <=' => $fechaCierre,
                    'ubicacion_id' => $ubicacion_id,
                    'estado_id !=' => 2
                ])->count();
        }
        
        $this->set(compact('labels', 'datos'));
        $this->set("_serialize", ['labels', 'datos']);
    }
}