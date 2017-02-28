<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DetalleUbicacionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DetalleUbicacionesTable Test Case
 */
class DetalleUbicacionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DetalleUbicacionesTable
     */
    public $DetalleUbicaciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.detalle_ubicaciones',
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
        $config = TableRegistry::exists('DetalleUbicaciones') ? [] : ['className' => 'App\Model\Table\DetalleUbicacionesTable'];
        $this->DetalleUbicaciones = TableRegistry::get('DetalleUbicaciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DetalleUbicaciones);

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
