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

        $this->insert(self::TABLE_NAME, [
            'parent' => 0,
            'content_id' => 367,
            'text' => '配置文件写错了，按下面的写就行，不用放在location下。rewrite ^/wish/(.*).jhtml$ /community/detail/$1.jhtml permanent;',
            'status' => 0,
            'ip' => '127.0.0.1',
            'create_at' => 1507864872
        ]);
        $this->insert(self::TABLE_NAME, [
            'parent' => 0,
            'content_id' => 367,
            'text' => '系统中有一个需求是将某一段url链接地址转链到另外一段地址，model类似于将localhost/wish/1234.jhtml自动转到localhost/community/detail/1234.jhtml',
            'status' => 0,
            'ip' => '127.0.0.1',
            'create_at' => 1507864872
        ]);
        $this->insert(self::TABLE_NAME, [
            'parent' => 1,
            'content_id' => 367,
            'text' => '确实是这样的',
            'status' => 0,
            'ip' => '127.0.0.1',
            'create_at' => 1507864872
        ]);
    }

    public function safeDown()
    {
        $this->dropIndex('parent', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }

}
