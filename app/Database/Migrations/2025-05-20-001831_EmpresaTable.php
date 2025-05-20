<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmpresaTable extends Migration
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
            'cnpj' => [
                'type' => 'VARCHAR',
                'constraint' => 14,
                'unique' => true,
                'null' => false,
            ],
            'descricao' => [
                'type' => 'TEXT',
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
            'fk_usuarios_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11,
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('fk_usuarios_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('empresas');
    }

    public function down()
    {
        $this->forge->dropTable('empresas');
    }
}
