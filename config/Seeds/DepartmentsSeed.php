<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Departments seed.
 */
class DepartmentsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $now = (new \Cake\I18n\FrozenTime())->format("Y-m-d H:i:s");
        $data = [
            [
                'id' => \Cake\Utility\Text::uuid(),
                'code' => 'PHP',
                'name' => 'PHP Backend Development',
                'status' => 'ACTIVE',
                'created' => $now,
                'modified' => $now
            ], [
                'id' => \Cake\Utility\Text::uuid(),
                'code' => 'ANGULAR',
                'name' => 'Angular Frontend Development',
                'status' => 'ACTIVE',
                'created' => $now,
                'modified' => $now
            ], [
                'id' => \Cake\Utility\Text::uuid(),
                'code' => 'HR',
                'name' => 'Human Resource Development',
                'status' => 'ACTIVE',
                'created' => $now,
                'modified' => $now
            ],
        ];

        $table = $this->table('departments');
        $table->truncate();
        $table->insert($data)->save();
    }
}
