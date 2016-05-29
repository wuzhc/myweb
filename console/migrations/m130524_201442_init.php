<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    const TABLE_NAME = '{{%user}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MYISAM';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string(50)->unique(),
            'phone' => $this->string(50)->unique(),
            'card_id' => $this->integer()->defaultValue(0),
            'nickname' => $this->string(50),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('card_id', self::TABLE_NAME, 'card_id', true);
    }

    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
