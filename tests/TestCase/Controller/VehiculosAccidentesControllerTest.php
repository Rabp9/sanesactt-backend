<?php
namespace App\Test\TestCase\Controller;

use App\Controller\VehiculosAccidentesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\VehiculosAccidentesController Test Case
 */
class VehiculosAccidentesControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
