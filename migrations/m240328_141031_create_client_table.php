<?php

use yii\db\Schema;
use yii\db\Migration;

class m240328_141031_create_client_table extends Migration
{
    public function up()
    {
        $this->createTable('client', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'cpf' => Schema::TYPE_STRING . ' NOT NULL',
            'address' => Schema::TYPE_STRING . ' NOT NULL',
            'address_number' => Schema::TYPE_INTEGER . ' NOT NULL',
            'city' => Schema::TYPE_STRING . ' NOT NULL',
            'state' => Schema::TYPE_STRING . ' NOT NULL',
            'complement' => Schema::TYPE_STRING,
            'photo' => Schema::TYPE_STRING,
            'sex' => Schema::TYPE_STRING,
        ], $this->tableOptions);

        // Add a unique index for the CPF field
        $this->createIndex('unique_client_cpf', 'client', 'cpf', true);
    }

    public function down()
    {
        $this->dropTable('client');
    }
}