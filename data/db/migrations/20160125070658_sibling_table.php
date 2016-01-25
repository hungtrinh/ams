<?php

use Phinx\Migration\AbstractMigration;

class SiblingTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('sibling')
            ->addColumn('username', 'string', [
                'limit'=> 100,
                'comment' => 'Sibling has relationship with username people'
            ])
            ->addColumn('fullname', 'string', ['limit' => 100, 'null' => false])
            ->addColumn('dob', 'date', ['null' => true])
            ->addColumn('work', 'string', ['limit' => 200, 'null' => true])
            ->addColumn('relationship', 'string', [
                'limit' => 50,
                'comment' => 'Relationship with username. Sister, brother...',
                'null' => false])
            ->addIndex(['username'])
            ->create();
    }
}
