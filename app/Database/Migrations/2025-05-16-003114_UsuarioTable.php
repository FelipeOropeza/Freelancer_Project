<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsuarioTable extends Migration
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
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => false,

            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
                'unique'     => true,
            ],
            'senha' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'tipo' => [
                'type' => "ENUM('admin','empresa','freelancer')",
                'null' => false,
            ],
            'email_valido' => [
                'type' => 'BOOLEAN',
                'default' => 0,
            ],
            'conduta' => [
                'type' => 'BOOLEAN',
                'default' => 0,
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}
