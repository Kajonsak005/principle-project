<?php

use yii\db\Migration;

/**
 * Class m230429_183955_booking
 */
class m230429_183955_booking extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('booking', [
            'id' => $this->primaryKey(),
            'user_id' => $this->string(255),
            'car_park_id' => $this->string(255),
            'payment_status' => $this->string(255),
            'create_time' => $this->dateTime(),
            'exit_time' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230429_183955_booking cannot be reverted.\n";
        $this->dropTable('booking');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230429_183955_booking cannot be reverted.\n";

        return false;
    }
    */
}