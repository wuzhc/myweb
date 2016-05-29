<?php

namespace common\models;

use backend\controllers\ArticleController;
use common\behavior\ArticleBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

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
class Article extends ActiveRecord
{
    public $content;

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
            [['title'], 'required'],
            [['summary'], 'string'],
            [['user_id', 'category_id', 'hits', 'comments', 'sort', 'status', 'create_at'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['image_url'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['user_id', 'category_id', 'create_at', 'content'], 'safe']
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => ArticleBehavior::className()
            ],
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

    /**
     * get the article author
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * get article content
     * @return \yii\db\ActiveQuery
     */
    public function getBody()
    {
        return $this->hasOne(ArticleContent::className(), ['article_id' => 'id']);
    }

    /**
     * get article category
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * upload file
     * @param UploadedFile $fileInstance
     * @return string
     */
    public function upload(UploadedFile $fileInstance)
    {
        if ($fileInstance instanceof UploadedFile) {
            if ($this->validate()) {

                $dirPath = 'uploads/' . date('Ymd') . '/';
                if (!is_dir($dirPath)) {
                    mkdir($dirPath);
                }

                $filePath = $dirPath . $fileInstance->baseName . '.' . $fileInstance->extension;
                $fileInstance->saveAs($filePath);

                return Yii::$app->request->hostInfo . '/' .$filePath;
            }
        }
        return '';
    }
}
