<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');

        for ($i = 0; $i < 10; $i++) {
            $data = [
                'nome'         => $faker->name,
                'email'        => $faker->unique()->safeEmail,
                'senha'        => password_hash('123456', PASSWORD_DEFAULT),
                'tipo'         => 'freelancer',
                'data_criacao' => date('Y-m-d'),
                'email_valido' => 1,
                'conduta'      => 0,
            ];

            $this->db->table('usuarios')->insert($data);
        }
    }
}
