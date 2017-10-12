<?php

use yii\db\Migration;

class m171011_095533_comment extends Migration
{
    const TABLE_NAME = 'comment';

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MYISAM';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'parent' => $this->integer()->defaultValue(0),
            'content_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'status' => $this->smallInteger()->defaultValue(0),
            'ip' => $this->char(15),
            'create_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('parent', self::TABLE_NAME, 'parent');
    }

    public function safeDown()
    {
        $this->dropIndex('parent', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }

}
