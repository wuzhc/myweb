<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%image_content}}".
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $content
 */
class ImageContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%image_content}}';
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
            'id' => 'ID',
            'content_id' => 'Content ID',
            'content' => 'Content',
        ];
    }
}
