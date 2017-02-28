<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccidentesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccidentesTable Test Case
 */
class AccidentesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccidentesTable
     */
    public $Accidentes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.accidentes',
        'app.ubicaciones',
        'app.causas',
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
        $config = TableRegistry::exists('Accidentes') ? [] : ['className' => 'App\Model\Table\AccidentesTable'];
        $this->Accidentes = TableRegistry::get('Accidentes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Accidentes);

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
