<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FreelancerSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $usuarios = $this->db->table('usuarios')
            ->where('tipo', 'freelancer')
            ->get()
            ->getResultArray();

        foreach ($usuarios as $usuario) {
            $data = [
                'cpf' => $faker->cpf(false),
                'descricao' => $faker->text(200),
                'especialidades' => implode(', ', $faker->randomElements(
                    ['Cozinha Brasileira', 'Cozinha Italiana', 'Cozinha Japonesa', 'Confeitaria', 'Panificação', 'Cozinha Vegetariana', 'Buffet', 'Gastronomia Molecular'],
                    rand(1, 3)
                )),
                'dias_disponiveis' => implode(', ', $faker->randomElements(
                    ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
                    rand(2, 5)
                )),
                'valor_diaria' => $faker->randomFloat(2, 100, 1000),
                'telefone' => $faker->numerify('###########'),
                'site' => $faker->domainName,
                'endereco' => $faker->address,
                'curriculo' => $faker->text(300),
                'fk_usuarios_id' => $usuario['id'],
            ];

            $this->db->table('freelancers')->insert($data);
        }
    }
}
