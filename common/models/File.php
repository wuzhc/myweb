<?php

namespace common\models;

use common\helper\DebugHelper;
use Yii;

/**
 * This is the model class for table "file".
 *
 * @property integer $id
 * @property integer $title
 * @property integer $article_id
 * @property integer $type_id
 * @property integer $category_id
 * @property string $url
 * @property string $ext
 * @property string $size
 * @property integer $create_at
 * @property integer $status
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_at'], 'required'],
            [['url'], 'string', 'max' => 255],
            [['ext'], 'string', 'max' => 20],
            [['size'], 'string', 'max' => 100],
            [['title', 'article_id', 'type_id', 'category_id', 'create_at', 'status'], 'safe']
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
            'article_id' => Yii::t('common\message', 'Article ID'),
            'type_id' => Yii::t('common\message', 'Type ID'),
            'category_id' => Yii::t('common\message', 'Category ID'),
            'url' => Yii::t('common\message', 'Url'),
            'ext' => Yii::t('common\message', 'Ext'),
            'size' => Yii::t('common\message', 'Size'),
            'create_at' => Yii::t('common\message', 'Create At'),
            'status' => Yii::t('common\message', 'Status'),
        ];
    }

    /**
     * batch insert data to file table
     * @param array $data
     * @return $this
     */
    public static function batchInsert(array $data)
    {
        return Yii::$app->db->createCommand()->batchInsert(File::tableName(),
            ['category_id', 'title', 'url', 'size', 'ext', 'create_at'], $data)
            ->execute();
    }
}
