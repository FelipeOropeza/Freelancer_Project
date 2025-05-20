<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FreelancerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'cpf' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
                'unique' => true,
                'null' => false,
            ],
            'descricao' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'especialidades' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'dias_disponiveis' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'valor_diaria' => [
                'type' => 'DECIMAL',
                'constraint' => '8,2',
                'null' => true,
            ],
            'telefone' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
                'null' => true,
            ],
            'site' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => true,
            ],
            'endereco' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'curriculo' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'fk_usuarios_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11,
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('fk_usuarios_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('freelancers');
    }

    public function down()
    {
        $this->forge->dropTable('freelancers');
    }
}
