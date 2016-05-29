<?php

use yii\db\Migration;

class m160528_134441_categories extends Migration
{
    const TABLE_NAME = '{{%categories}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MYISAM';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'parent' => $this->integer()->defaultValue(0),
            'title' => $this->string(100)->notNull(),
            'sort' => $this->integer()->defaultValue(0),
            'status' => $this->smallInteger()->defaultValue(0),
            'create_at' => $this->integer()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        echo "m160528_134441_categories cannot be reverted.\n";

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
