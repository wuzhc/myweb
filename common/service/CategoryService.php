<?php

namespace common\service;


use common\models\Categories;
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
        return Categories::find()->where($args['condition'])->orderBy('path asc')->all();
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
        return $category ? $category->path : '';
    }

}