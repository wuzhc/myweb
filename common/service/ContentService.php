<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/29
 * Time: 20:00
 */

namespace common\service;


use Yii;
use common\helper\DebugHelper;
use common\models\Content;
use common\models\ArticleContent;
use common\models\ImageContent;
use yii\base\InvalidValueException;
use yii\base\Model;
use yii\data\ActiveDataProvider;

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
     * save content in article_content table
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
     * save content in image_content table
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

    /**
     * @param array $args
     * @param int $pageSize
     * @return ActiveDataProvider
     */
    public function getContents(array $args, $pageSize = 5)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->findQuery($args),
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);
        return $dataProvider;
    }

    /**
     * @param array $args
     * @return null|static
     */
    public function getContent(array $args)
    {
        return Content::findOne($args);
    }

    /**
     * @param array $args
     * @return \yii\db\ActiveQuery
     */
    public function findQuery(array $args)
    {
        $query = Content::find();

        if (isset($args['select'])) {
            $query->select($args['select']);
        }
        if (isset($args['with'])) {
            $query->joinWith($args['with']);
        }
        if (isset($args['id'])) {
            $query->andFilterWhere(['id' => $args['id']]);
        }
        if (isset($args['title'])) {
            $query->andFilterWhere(['like', 'title', $args['title']]);
        }
        if (isset($args['userID'])) {
            $query->andFilterWhere(['user_id' => $args['userID']]);
        }
        if (isset($args['categoryID'])) {
            $query->andFilterWhere(['category_id' => $args['categoryID']]);
        }
        if (isset($args['modelID'])) {
            $query->andFilterWhere(['model_id' => $args['modelID']]);
        }
        if (isset($args['status'])) {
            $query->andFilterWhere(['status' => $args['status']]);
        }
        if (isset($args['order'])) {
            $query->addOrderBy($args['order']);
        }
        if (isset($args['group'])) {
            $query->addGroupBy($args['group']);
        }
        if (isset($args['limit'])) {
            $query->limit($args['limit']);
        }
        if (isset($args['offset'])) {
            $query->offset($args['offset']);
        }

        return $query;
    }


    public function getLimitArticle($categoryIDs, $limit = 6)
    {
        $sql = "select a1.* from content a1
                inner join
                (select a.category_id,a.create_at from content a left join content b
                on a.category_id=b.category_id and a.create_at<=b.create_at
                group by a.category_id,a.create_at
                having count(b.create_at)<= $limit
                )b1
                on a1.category_id=b1.category_id and a1.create_at=b1.create_at
                WHERE a1.category_id IN ($categoryIDs) AND a1.status=0
                order by a1.category_id,a1.create_at desc
                ";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }
}