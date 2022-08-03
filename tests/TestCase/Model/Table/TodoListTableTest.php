<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TodoListTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TodoListTable Test Case
 */
class TodoListTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TodoListTable
     */
    public $TodoList;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TodoList',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TodoList') ? [] : ['className' => TodoListTable::class];
        $this->TodoList = TableRegistry::getTableLocator()->get('TodoList', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TodoList);

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
}
