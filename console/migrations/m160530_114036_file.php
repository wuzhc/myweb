<?php

use yii\db\Migration;

class m160530_114036_file extends Migration
{
    const TABLE_NAME = '{{%file}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MYISAM';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->defaultValue(null),
            'type_id' => $this->integer()->defaultValue(null),
            'url' => $this->string(),
            'ext' => $this->string(20),
            'size' => $this->string(100),
            'create_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->defaultValue(0),
        ], $tableOptions);

    }

    public function down()
    {
        echo "m160530_114036_file cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
