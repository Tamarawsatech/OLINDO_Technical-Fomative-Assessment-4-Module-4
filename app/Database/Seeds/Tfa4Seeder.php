<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class Tfa4Seeder extends Seeder
{
    public function run()
    {
        $model = new UserModel();
        $username = 'kcolindo';
        $password = 'admin12345!';
        $user = $model->where('username', $username)->first();

        $data = [
            'username'  => $username,
            'full_name' => 'Karl Colindo',
            'password'  => password_hash($password, PASSWORD_DEFAULT),
            'avatar'    => null,
        ];

        if ($user) {
            $model->update($user['id'], $data);
            return;
        }

        $model->insert($data);
    }
}
