<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%model}}".
 *
 * @property integer $id
 * @property string $title
 */
class Model extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%model}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
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
            'title' => Yii::t('common\message', 'Title'),
        ];
    }
}
