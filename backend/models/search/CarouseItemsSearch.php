<?php

namespace plathir\smartblog\backend\models\search;


use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * CarouselSearch represents the model behind the search form of `apps\recipes\backend\models\CarouselItems`.
 */
class CarouselItemsSearch extends Carousel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'carousel_id', 'recipe_id'], 'integer'],
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
        $query = Carousel::find();

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
            'carousel_id' => $this->carousel_id,
            'recipe_id' => $this->recipe_id,
        ]);

        return $dataProvider;
    }
}
