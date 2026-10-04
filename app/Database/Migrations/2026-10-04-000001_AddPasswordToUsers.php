<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordToUsers extends Migration
{
    private const INITIAL_PASSWORD = 'admin12345!';

    public function up()
    {
        $fields = $this->db->getFieldNames('users');

        if (! in_array('password', $fields, true)) {
            $this->forge->addColumn('users', [
                'password' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                    'after'      => 'username',
                ],
            ]);
        }

        $hash = password_hash(self::INITIAL_PASSWORD, PASSWORD_DEFAULT);

        $this->db->table('users')
            ->where('password IS NULL', null, false)
            ->update(['password' => $hash]);

        $this->forge->modifyColumn('users', [
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
                'after'      => 'username',
            ],
        ]);
    }

    public function down()
    {
        if (in_array('password', $this->db->getFieldNames('users'), true)) {
            $this->forge->dropColumn('users', 'password');
        }
    }
}
