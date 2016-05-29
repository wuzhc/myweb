<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%categories}}".
 *
 * @property integer $id
 * @property integer $parent
 * @property string $title
 * @property integer $sort
 * @property integer $status
 * @property integer $create_at
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'sort', 'status', 'create_at'], 'integer'],
            [['title', 'create_at'], 'required'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common\message', 'ID'),
            'parent' => Yii::t('common\message', 'Parent'),
            'title' => Yii::t('common\message', 'Title'),
            'sort' => Yii::t('common\message', 'Sort'),
            'status' => Yii::t('common\message', 'Status'),
            'create_at' => Yii::t('common\message', 'Create At'),
        ];
    }
}
