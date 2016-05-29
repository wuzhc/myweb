<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property integer $user_id
 * @property integer $category_id
 * @property string $image_url
 * @property integer $hits
 * @property integer $comments
 * @property integer $sort
 * @property integer $status
 * @property integer $create_at
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'user_id', 'category_id', 'create_at'], 'required'],
            [['summary'], 'string'],
            [['user_id', 'category_id', 'hits', 'comments', 'sort', 'status', 'create_at'], 'integer'],
            [['title', 'image_url'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common\messages', 'ID'),
            'title' => Yii::t('common\messages', 'Title'),
            'summary' => Yii::t('common\messages', 'Summary'),
            'user_id' => Yii::t('common\messages', 'User ID'),
            'category_id' => Yii::t('common\messages', 'Category ID'),
            'image_url' => Yii::t('common\messages', 'Image Url'),
            'hits' => Yii::t('common\messages', 'Hits'),
            'comments' => Yii::t('common\messages', 'Comments'),
            'sort' => Yii::t('common\messages', 'Sort'),
            'status' => Yii::t('common\messages', 'Status'),
            'create_at' => Yii::t('common\messages', 'Create At'),
        ];
    }
}
