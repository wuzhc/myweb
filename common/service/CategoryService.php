<?php

namespace common\service;


use common\config\Conf;
use common\helper\CacheHelper;
use common\models\Model;
use Yii;
use common\models\Categories;
use yii\caching\Cache;
use yii\helpers\ArrayHelper;


class CategoryService extends AbstractService
{
    /**
     * Returns the static model.
     * @param string $className service class name.
     * @return CategoryService the static model class
     */
    public static function factory($className = __CLASS__)
    {
        return parent::factory($className);
    }

    /**
     * get categories
     * @param array $args Filter conditions
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCategories($args = array())
    {
        $category = Categories::find();
        if ($args['parent']) {
            $category->andFilterWhere(['parent' => $args['parent']]);
        }
        if ($args['title']) {
            $category->andFilterWhere(['like', 'title', $args['title']]);
        }
        if ($args['model_id']) {
            $category->andFilterWhere(['model_id' => $args['model_id']]);
        }
        if ($args['level']) {
            $category->andFilterWhere(['level' => $args['level']]);
        }
        if ($args['status']) {
            $category->andFilterWhere(['status' => $args['status']]);
        }
        if ($args['with']) {
            $category->with($args['with']);
        }
        if ($args['limit']) {
            $category->limit($args['limit']);
        }
        return $category->orderBy('path asc')->all();
    }

    /**
     * The corresponding relation of ID and title
     *
     * @param array $args Filter conditions
     * @param string $from key
     * @param string $to value
     * @return array
     * [
     *      'key' => 'value',
     * ]
     */
    public function getCategoriesMap($args = array(), $from = 'id', $to = 'title')
    {
        $categories = $this->getCategories($args);
        return ArrayHelper::map($categories, $from, $to);
    }

    /**
     * get parent path
     *
     * @param $parentID
     * @return mixed|string
     */
    public function getParentPath($parentID)
    {
        $category = Categories::find()->where('id = :parentID', [':parentID' => $parentID])->one();
        return $category ? $category->path : '0';
    }

    public function getArticleCategories()
    {
        return CacheHelper::getCache('article:categories', function() {
            $categories = Categories::find()->where('path like "0-1-201%"')->all();
            return ArrayHelper::map($categories, 'id', 'title');
        });
    }

    public function getImageCategories()
    {
        return CacheHelper::getCache('image:categories', function() {
            $categories = Categories::find()->where('path like "0-1-202%"')->all();
            return ArrayHelper::map($categories, 'id', 'title');
        });
    }

    /**
     * home page nav
     * @return callable|mixed|null
     */
    public function getHomePageNav() {
        return CacheHelper::getCache('home:page:nav', function() {
            $categories = $this->getCategories([
                'model_id' => Conf::ARTICLE_MODEL,
                'limit' => 7,
                'level' => 1,
                'order' => 'sort DESC,id DESC',
            ]);
            return ArrayHelper::map($categories, 'id', 'title');
        });
    }

    /**
     * model e.g. image,article
     * @return array
     */
    public function getModels()
    {
        $models = Model::find()->all();
        return ArrayHelper::map($models, 'id', 'title');
    }

    /**
     * @param $parentID
     * @return array
     */
    public function getChildCategories($parentID)
    {
        $categories = $this->getCategories(['parent' => $parentID]);
        return ArrayHelper::map($categories, 'id', 'title');
    }
}