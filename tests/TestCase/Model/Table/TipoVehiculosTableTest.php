<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoVehiculosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoVehiculosTable Test Case
 */
class TipoVehiculosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoVehiculosTable
     */
    public $TipoVehiculos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tipo_vehiculos',
        'app.estados',
        'app.accidentes',
        'app.ubicaciones',
        'app.detalle_ubicaciones',
        'app.causas',
        'app.detalle_causas',
        'app.detalle_accidentes',
        'app.clase_vehiculos',
        'app.tipo_servicios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TipoVehiculos') ? [] : ['className' => 'App\Model\Table\TipoVehiculosTable'];
        $this->TipoVehiculos = TableRegistry::get('TipoVehiculos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TipoVehiculos);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
