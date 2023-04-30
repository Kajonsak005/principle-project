<?php

use yii\db\Migration;

/**
 * Class m230429_182549_car_park
 */
class m230429_182549_car_park extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('car_park', [
            'id' => $this->primaryKey(),
            'available' => $this->string(255),
            'available_now' => $this->string(255),
            'zone' => $this->string(255),
            'status' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230429_182549_car_park cannot be reverted.\n";
        $this->dropTable('car_park');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230429_182549_car_park cannot be reverted.\n";

        return false;
    }
    */
}