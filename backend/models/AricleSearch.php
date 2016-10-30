<?php

namespace backend\models;

use common\config\Conf;
use common\models\Content;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * AricleSearch represents the model behind the search form about `common\models\Article`.
 */
class AricleSearch extends Content
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id', 'user_id', 'category_id', 'hits', 'comments', 'sort', 'status', 'create_at'], 'integer'],
            [['id', 'user_id', 'category_id', 'hits', 'comments', 'sort', 'status','title', 'summary', 'image_url', 'create_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Content::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'hits' => $this->hits,
            'comments' => $this->comments,
            'sort' => $this->sort,
            'status' => $this->status,
            'create_at' => $this->create_at,
            'model_id' => Conf::ARTICLE_MODEL,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'image_url', $this->image_url]);

        $query->addOrderBy(['id' => SORT_DESC]);

        return $dataProvider;
    }
}
