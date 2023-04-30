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
            'id' => $this->primaryKey(),
            'image' => $this->string(255),
            'username' => $this->string(255),
            'password' => $this->string(255),
            'money' => $this->string(255),
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