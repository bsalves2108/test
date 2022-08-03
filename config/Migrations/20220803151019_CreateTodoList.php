<?php

use Migrations\AbstractMigration;

class CreateTodoList extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('todo_list');
        $table->addColumn('task', 'string', ['default' => null, 'limit' => 255, 'null' => false,]);
        $table->addColumn('created', 'datetime', ['default' => null, 'null' => false,]);
        $table->addColumn('modified', 'datetime', ['default' => null, 'null' => false,]);
        $table->create();
    }
}
