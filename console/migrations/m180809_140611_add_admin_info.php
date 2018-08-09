<?php

use yii\db\Migration;

/**
 * Class m180809_140611_add_admin_info
 */
class m180809_140611_add_admin_info extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%admin}}', [
            'id' => 1,
            'username' => 'jiangming',
            'auth_key' => '',
            'password_hash' => password_hash('123456789j*m*', PASSWORD_DEFAULT),
            'password_reset_token' => '',
            'email' => 'jmphper@foxmail.com',
            'status' => '1',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180809_140611_add_admin_info cannot be reverted.\n";

        $this->delete('{{%admin}}', ['id' => 1]);

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180809_140611_add_admin_info cannot be reverted.\n";

        return false;
    }
    */
}
