<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/29
 * Time: 20:00
 */

namespace common\service;


use common\helper\DebugHelper;
use common\models\Content;
use common\models\ArticleContent;
use common\models\ImageContent;
use yii\base\InvalidValueException;
use yii\base\Model;

class ContentService extends AbstractService
{
    /**
     * Returns the static model.
     * @param string $className service class name.
     * @return ContentService the static model class
     */
    public static function factory($className = __CLASS__)
    {
        return parent::factory($className);
    }

    /**
     * find article model
     * @param $id
     * @return Article|null|static
     */
    public function findContentModel($id = null)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            return new Article();
        }
    }

    /**
     * save article content
     * @param array $data
     * @param null $find
     * @return bool
     */
    public function saveArticleContent(array $data, $find = null)
    {
        if ($find) {
            $model = ArticleContent::find()->where($find)->one();
        } else {
            $model = new ArticleContent();
        }

        return $this->saveContent($model, $data);
    }

    /**
     * save image content
     * @param array $data
     * @param null $find
     * @return bool
     */
    public function saveImageContent(array $data, $find = null)
    {
        if ($find) {
            $model = ImageContent::find()->where($find)->one();
        } else {
            $model = new ImageContent();
        }

        return $this->saveContent($model, $data);
    }

    /**
     * save content
     * @param Model $model
     * @param array $data
     * @return bool
     */
    public function saveContent(Model $model, array $data)
    {
        if (!($model && $data)) {
            throw new \InvalidArgumentException('Illegal argument');
        }

        if (!($model instanceof Model)) {
            return false;
        }

        $model->content_id = $data['contentID'];
        $model->content = $data['content'];
        return $model->save();
    }

}