<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DetalleCausasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DetalleCausasTable Test Case
 */
class DetalleCausasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DetalleCausasTable
     */
    public $DetalleCausas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.detalle_causas',
        'app.causas',
        'app.estados',
        'app.accidentes',
        'app.ubicaciones',
        'app.detalle_ubicaciones',
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
        $config = TableRegistry::exists('DetalleCausas') ? [] : ['className' => 'App\Model\Table\DetalleCausasTable'];
        $this->DetalleCausas = TableRegistry::get('DetalleCausas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DetalleCausas);

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
