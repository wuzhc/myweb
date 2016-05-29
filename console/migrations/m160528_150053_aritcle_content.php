<?php

use yii\db\Migration;

class m160528_150053_aritcle_content extends Migration
{
    const TABLE_NAME = '{{%article_content}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MYISAM';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->unique(),
            'content' => $this->text(),
        ], $tableOptions);

        $this->addForeignKey('fk_article_id', self::TABLE_NAME, '[[article_id]]', '{{%article}}', '[[id]]' , 'RESTRICT', 'CASCADE');
    }


    public function down()
    {
        echo "m160528_150053_aritcle_content cannot be reverted.\n";

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
