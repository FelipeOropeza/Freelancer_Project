<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContratoTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'      => true,
                'auto_increment' => true,
            ],
            'status' => [
                'type' => "ENUM('pendente','aceito','recusada')",
                'null' => false,
                'default' => 'pendente',
            ],
            'fk_empresa_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'fk_freelancer_id' => [
                'type'       => 'INT',
                'unsigned'  => true,
            ],
            'fk_proposta_freelancer_id' => [
                'type'       => 'INT',
                'unsigned'  => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('fk_empresa_id', 'empresas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('fk_freelancer_id', 'freelancers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('fk_proposta_freelancer_id', 'proposta_freelancer', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('contratos');
    }

    public function down()
    {
        $this->forge->dropTable('contratos');
    }
}
