<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PropostaTable extends Migration
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
            'titulo' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'descricao' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'valor' => [
                'type' => 'DECIMAL',
                'constraint' => '8,2',
                'null' => false,
            ],
            'data_inicio' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'data_conclusao' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'tipo' => [
                'type' => "ENUM('remoto','presencial','hibrido')",
                'null' => false,
            ],
            'endereco' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'fk_empresas_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11,
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('fk_empresas_id', 'empresas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('propostas');
    }

    public function down()
    {
        $this->forge->dropTable('propostas');
    }
}
