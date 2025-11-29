<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFullNameToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'full_name');
    }
}
