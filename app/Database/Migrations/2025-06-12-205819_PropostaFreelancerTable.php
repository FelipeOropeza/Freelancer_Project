<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PropostaFreelancerTable extends Migration
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
            'status' => [
                'type' => "ENUM('pendente','aceita','recusada')",
                'null' => false,
                'default' => 'pendente',
            ],
            'fk_propostas_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11,
            ],
            'fk_freelancers_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('fk_propostas_id', 'propostas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('fk_freelancers_id', 'freelancers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('proposta_freelancer');
    }

    public function down()
    {
        $this->forge->dropTable('proposta_freelancer');
    }
}
