<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateEvent extends AbstractMigration
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
        $table = $this->table('event');
        $table->addColumn('title', 'string', ['default' => null, 'limit' => 255, 'null' => false,]);
        $table->addColumn('all_day', 'boolean', ['default' => false, 'null' => false,]);
        $table->addColumn('start_at', 'datetime', ['default' => null, 'null' => false,]);
        $table->addColumn('end_at', 'datetime', ['default' => null, 'null' => false,]);
        $table->addColumn('created', 'datetime', ['default' => null, 'null' => false,]);
        $table->addColumn('modified', 'datetime', ['default' => null, 'null' => false,]);
        $table->create();
    }
}
