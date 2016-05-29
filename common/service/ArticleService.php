<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/29
 * Time: 20:00
 */

namespace common\service;


use common\models\Article;
use common\models\ArticleContent;

class ArticleService extends AbstractService
{
    /**
     * Returns the static model.
     * @param string $className service class name.
     * @return ArticleService the static model class
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
    public function findArticleModel($id = null)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            return new Article();
        }
    }


}