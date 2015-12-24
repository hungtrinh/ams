<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\AdapterInterface;

class ZfcUserTable extends AbstractMigration
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
         $this->table('user', ['id' => 'user_id'])
            ->addColumn('username', AdapterInterface::PHINX_TYPE_STRING, [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('email', AdapterInterface::PHINX_TYPE_STRING, [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('display_name', AdapterInterface::PHINX_TYPE_STRING, [
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('password', AdapterInterface::PHINX_TYPE_STRING, [
                'limit' => 128,
                'null' => false,
            ])
            ->addColumn('state', AdapterInterface::PHINX_TYPE_INTEGER)
            ->addIndex(['username'], ['unique' => true])
            ->addIndex(['email'], ['unique' => true])
            ->create();
    }
}
