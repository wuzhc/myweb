<?php

namespace common\models;

use common\service\CategoryService;
use Yii;
use yii\db\ActiveRecord;
use common\behavior\CategoryBehavior;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "{{%categories}}".
 *
 * @property integer $id
 * @property integer $parent
 * @property string $title
 * @property integer $sort
 * @property integer $level
 * @property integer $path
 * @property integer $status
 * @property integer $create_at
 */
class Categories extends ActiveRecord
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
            [['title'], 'required'],
            [['title'], 'string', 'max' => 100],
            [['id', 'parent', 'sort', 'path', 'level', 'status', 'create_at','title'], 'safe'],
        ];
    }

    public function behaviors()
    {
        return [
            /*[
                'class' => CategoryBehavior::className()
            ],*/
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at'],
                ],
            ],
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
            'level' => Yii::t('common\message', 'level'),
            'path' => Yii::t('common\message', 'path'),
            'create_at' => Yii::t('common\message', 'Create At'),
        ];
    }

    public function saveCategoryPath()
    {
        $this->path = $this->parentPath . '-' . $this->id;
        $this->level = substr_count($this->path, '-');
        $this->save();
    }

    public function getParentPath()
    {
        return CategoryService::factory()->getParentPath($this->parent);
    }

}
