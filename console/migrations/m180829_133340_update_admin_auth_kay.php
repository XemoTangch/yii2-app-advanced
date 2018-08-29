<?php

use yii\db\Migration;

/**
 * Class m180829_133340_update_admin_auth_kay
 */
class m180829_133340_update_admin_auth_kay extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%admin}}', 'auth_key', 'varchar(255) not null default ""');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180829_133340_update_admin_auth_kay cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180829_133340_update_admin_auth_kay cannot be reverted.\n";

        return false;
    }
    */
}
