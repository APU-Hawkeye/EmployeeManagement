<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
                'first_name' => 'Swarup',
                'last_name' => 'Saha',
                'username' => 'admin',
                'email' => 'swarup1odev@gmail.com',
                'password' => (new \Authentication\PasswordHasher\DefaultPasswordHasher())->hash("Secret"),
                'password_updated' => null,
                'disabled' => null,
                'created' => $now,
                'modified' => $now
            ]
        ];

        $table = $this->table('users');
        $table->truncate();
        $table->insert($data)->save();
    }
}
