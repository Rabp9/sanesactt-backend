<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VehiculosAccidentesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VehiculosAccidentesTable Test Case
 */
class VehiculosAccidentesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VehiculosAccidentesTable
     */
    public $VehiculosAccidentes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vehiculos_accidentes',
        'app.clase_vehiculos',
        'app.tipo_servicios',
        'app.estados',
        'app.accidentes',
        'app.ubicaciones',
        'app.causas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('VehiculosAccidentes') ? [] : ['className' => 'App\Model\Table\VehiculosAccidentesTable'];
        $this->VehiculosAccidentes = TableRegistry::get('VehiculosAccidentes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VehiculosAccidentes);

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
