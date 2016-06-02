<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%article_content}}".
 *
 * @property integer $id
 * @property integer $content_id
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
            [['content_id'], 'integer'],
            [['content'], 'string'],
            [['content_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common\message', 'ID'),
            'content_id' => Yii::t('common\message', 'Content ID'),
            'content' => Yii::t('common\message', 'Content'),
        ];
    }

    /**
     * @param $args
     * @return ArticleContent|null|static
     */
    public static function findModel($args)
    {
        if (($model = ArticleContent::findOne($args)) !== null) {
            return $model;
        } else {
            return new ArticleContent();
        }
    }
}
