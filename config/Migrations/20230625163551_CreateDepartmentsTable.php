<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateDepartmentsTable extends AbstractMigration
{

    public function down()
    {
        $this->table('departments')->drop()->save();
        $this->execute("DROP TYPE dpt_status");
    }

    public function up()
    {
        $this->execute("CREATE TYPE dpt_status AS ENUM ('ACTIVE', 'NOT-ACTIVE')");
        $table = $this->table('departments', [
            'id' => false,
            'primary_key' => 'id'
        ]);
        $table
            ->addColumn('id', 'uuid')
            ->addColumn('code', 'string')
            ->addColumn('name', 'text')
            ->addColumn('status', \Phinx\Util\Literal::from('dpt_status'), [
                'default' => 'ACTIVE',
                'null' => false,
            ])
            ->addColumn("created", "datetime")
            ->addColumn("modified", "datetime")
            ->addIndex(["code"], [
                "unique" => true,
                "name" => "uniq_department_code"
            ])
            ->create();
    }
}
