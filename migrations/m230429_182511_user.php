<?php

use yii\db\Migration;

/**
 * Class m230429_182511_user
 */
class m230429_182511_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->createTable('users', [
            'id' => 'UUID NOT NULL PRIMARY KEY',
            'email' => Schema::TYPE_STRING . ' NULL',
            'password' => Schema::TYPE_STRING . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'surname' => Schema::TYPE_STRING . ' NOT NULL',
            'mobile_number' => Schema::TYPE_STRING . ' NULL',
            'image_profile' => Schema::TYPE_STRING . ' NULL', 
            'update_id' => 'UUID NULL',
            'create_time' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'update_time' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230429_182511_user cannot be reverted.\n";
        $this->dropTable('users');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230429_182511_user cannot be reverted.\n";

        return false;
    }
    */
}
