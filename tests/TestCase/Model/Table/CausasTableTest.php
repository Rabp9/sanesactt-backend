<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CausasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CausasTable Test Case
 */
class CausasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CausasTable
     */
    public $Causas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Causas') ? [] : ['className' => 'App\Model\Table\CausasTable'];
        $this->Causas = TableRegistry::get('Causas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Causas);

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
