<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPhoneToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,  // Set to false if you want this field to be required
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'phone');
    }
}
