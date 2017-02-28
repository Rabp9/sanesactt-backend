<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClaseVehiculosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClaseVehiculosTable Test Case
 */
class ClaseVehiculosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClaseVehiculosTable
     */
    public $ClaseVehiculos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.clase_vehiculos',
        'app.tipo_servicios',
        'app.estados'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ClaseVehiculos') ? [] : ['className' => 'App\Model\Table\ClaseVehiculosTable'];
        $this->ClaseVehiculos = TableRegistry::get('ClaseVehiculos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClaseVehiculos);

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
