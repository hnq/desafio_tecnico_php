<?php

use yii\db\Schema;
use yii\db\Migration;

class m240328_170114_create_product_table extends Migration
{
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'price' => $this->decimal(10,2)->notNull(),
            'client_id' => $this->integer()->notNull(),
            'photo' => $this->string(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $this->tableOptions);
        
        $this->createIndex('unique_product_id', 'product', 'id', true);
    }

    public function down()
    {
        $this->dropTable('product');
    }
}