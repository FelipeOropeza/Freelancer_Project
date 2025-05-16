<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmailTable extends Migration
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
            'assunto' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
            ],
            'mensagem' => [
                'type' => 'TEXT'
            ],
            'data_envio' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'fk_usuarios_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11,
            ]
        ]);


        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('fk_usuarios_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable(table: 'emails');
    }

    public function down()
    {
        $this->forge->dropTable('emails');
    }
}
