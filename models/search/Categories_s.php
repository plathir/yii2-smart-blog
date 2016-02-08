<?php

namespace plathir\smartblog\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use plathir\smartblog\models\Categories;

/**
 * Posts_s represents the model behind the search form about `app\models\Posts`.
 */
class Categories_s extends Posts {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'full_image', 'user_created', 'user_last_change', 'publish'], 'integer'],
            [['description', 'intro_text', 'full_text', 'intro_image', 'date_created', 'date_last_change', 'categories'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Posts::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'full_image' => $this->full_image,
            'user_created' => $this->user_created,
            'date_created' => $this->date_created,
            'user_last_change' => $this->user_last_change,
            'date_last_change' => $this->date_last_change,
            'publish' => $this->publish,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'intro_text', $this->intro_text])
                ->andFilterWhere(['like', 'full_text', $this->full_text])
                ->andFilterWhere(['like', 'intro_image', $this->intro_image])
                ->andFilterWhere(['like', 'categories', $this->categories]);

        return $dataProvider;
    }

}
