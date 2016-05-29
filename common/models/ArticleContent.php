<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%article_content}}".
 *
 * @property integer $id
 * @property integer $article_id
 * @property string $content
 */
class ArticleContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id'], 'integer'],
            [['content'], 'string'],
            [['article_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common\message', 'ID'),
            'article_id' => Yii::t('common\message', 'Article ID'),
            'content' => Yii::t('common\message', 'Content'),
        ];
    }
}
