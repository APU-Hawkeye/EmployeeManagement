<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateEmployeesTable extends AbstractMigration
{

    public function down()
    {
        $this->table('employees')->drop()->save();
        $this->execute("DROP TYPE emp_status");
    }

    public function up()
    {
        $this->execute("CREATE TYPE emp_status AS ENUM ('ACTIVE', 'NOT-ACTIVE')");
        $table = $this->table('employees', [
            'id' => false,
            'primary_key' => 'id'
        ]);
        $table
            ->addColumn('id', 'uuid')
            ->addColumn('department_id', 'uuid')
            ->addColumn('first_name', 'text')
            ->addColumn('middle_name', 'text', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('last_name', 'text')
            ->addColumn('dob', 'date')
            ->addColumn('phone', 'integer')
            ->addColumn('email', 'string')
            ->addColumn('photo', 'text')
            ->addColumn('salary', 'integer')
            ->addColumn('status', \Phinx\Util\Literal::from('emp_status'), [
                'default' => 'ACTIVE',
                'null' => false,
            ])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();
    }
}
