<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\AdapterInterface;

class StudentTable extends AbstractMigration
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
        $this->table('student')
            ->addColumn('user', AdapterInterface::PHINX_TYPE_STRING, [
                'limit' => 255,
                'null' => false,
                'comment' => 'account username, may be user_id is good choice',
            ])
            ->addColumn('registration_code', AdapterInterface::PHINX_TYPE_STRING, [
                'limit' => 7,
                'null' => true,
                'comment' => 'Registration code of school',
            ])
            ->addColumn('fullname', AdapterInterface::PHINX_TYPE_STRING, [
                'limit' => 100,
                'null' => true,
                'comment' => 'Fullname',
            ])
            ->addColumn('phonetic_name', AdapterInterface::PHINX_TYPE_STRING, [
                'limit' => 100,
                'null' => true,
                'comment' => 'phonetic name',
            ])
            ->addColumn('dob', AdapterInterface::PHINX_TYPE_DATE, [
                'null' => true,
                'comment' => 'date of birth',
            ])
            ->addColumn('gender', AdapterInterface::PHINX_TYPE_STRING, [
                'null' => true,
                'comment' => 'sex',
            ])
            ->addColumn('grade', AdapterInterface::PHINX_TYPE_INTEGER, [
                'null' => true,
                'comment' => 'Grade',
            ])
            ->addIndex(['user'], ['unique' => true])
            ->create();
    }
}
