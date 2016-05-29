<?php

use yii\db\Migration;

class m160528_135409_article extends Migration
{
    const TABLE_NAME = '{{%article}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MYISAM';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'title' => $this->string(200)->notNull(),
            'summary' => $this->text(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'image_url' => $this->string(200),
            'hits' => $this->integer()->defaultValue(0),
            'comments' => $this->integer()->defaultValue(0),
            'sort' => $this->integer()->defaultValue(0),
            'status' => $this->smallInteger()->defaultValue(0),
            'create_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('user_id', self::TABLE_NAME, 'user_id');
        $this->createIndex('category_id', self::TABLE_NAME, 'category_id');

        $this->addForeignKey('fk_user_id', self::TABLE_NAME, '[[user_id]]', '{{%user}}', '[[id]]' , 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_category_id', self::TABLE_NAME, '[[category_id]]', '{{%categories}}', '[[id]]' , 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        echo "m160528_135409_article cannot be reverted.\n";

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
