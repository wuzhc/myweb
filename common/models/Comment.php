<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property int $id
 * @property int $parent
 * @property int $content_id
 * @property string $text
 * @property int $status
 * @property string $ip
 * @property int $create_at
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'content_id', 'status', 'create_at'], 'integer'],
            [['content_id', 'text', 'create_at'], 'required'],
            [['text'], 'string'],
            [['ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent' => 'Parent',
            'content_id' => 'Content ID',
            'text' => 'Text',
            'status' => 'Status',
            'ip' => 'Ip',
            'create_at' => 'Create At',
        ];
    }
}
