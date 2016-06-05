<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Categories;

/**
 * CategorySearch represents the model behind the search form about `common\models\Categories`.
 */
class CategorySearch extends Categories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent', 'model_id', 'sort', 'status', 'create_at','title'], 'safe'],
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
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Categories::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'model_id' => $this->model_id,
            'parent' => $this->parent,
            'status' => $this->status,
            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        $sort = $this->sort == 'desc' ? SORT_DESC : SORT_ASC;
        $query->addOrderBy(['model_id' => SORT_ASC, 'path' => SORT_ASC, 'sort' => $sort]);

        return $dataProvider;
    }
}
