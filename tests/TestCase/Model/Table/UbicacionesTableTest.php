<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UbicacionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UbicacionesTable Test Case
 */
class UbicacionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UbicacionesTable
     */
    public $Ubicaciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ubicaciones',
        'app.estados',
        'app.accidentes',
        'app.causas',
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
        $config = TableRegistry::exists('Ubicaciones') ? [] : ['className' => 'App\Model\Table\UbicacionesTable'];
        $this->Ubicaciones = TableRegistry::get('Ubicaciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ubicaciones);

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
