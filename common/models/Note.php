<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%note}}".
 *
 * @property integer $id
 * @property string $content
 * @property string $time
 * @property integer $status
 */
class Note extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%note}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['time'], 'safe'],
            [['status'], 'integer'],
            [['content'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'time' => 'Time',
            'status' => 'Status',
        ];
    }
}
