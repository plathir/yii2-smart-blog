<?php

namespace plathir\smartblog\frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use plathir\smartblog\frontend\models\Posts as Posts;

/**
 * Posts_s represents the model behind the search form about `app\models\Posts`.
 */
class Posts_s extends Posts {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'full_image', 'user_created', 'user_last_change', 'publish'], 'integer'],
            [['description', 'intro_text', 'full_text', 'intro_image', 'created_at', 'updated_at', 'tags'], 'safe'],
            [['category'], 'string'],
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
            'user_last_change' => $this->user_last_change,
            'publish' => $this->publish,
        ]);

        if ($this->created_at) {
            $date_cr = date('d-m-Y', (float) $this->created_at);
        } else {
            $date_cr = '';
        }

        if ($this->updated_at) {
            $date_up = date('d-m-Y', (float) $this->updated_at);
        } else {
            $date_up = '';
        }

        if ($this->category) {
            $categoryArray = explode(",", $this->category);
            $query->andFilterWhere(['in', 'category', $categoryArray]);
        }

        $query->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'intro_text', $this->intro_text])
                ->andFilterWhere(['like', 'full_text', $this->full_text])
                ->andFilterWhere(['like', 'intro_image', $this->intro_image])
                ->andFilterWhere(['like', "date_format(date(from_unixtime(created_at)) ,'%d-%m-%Y' )", $date_cr])
                ->andFilterWhere(['like', "date_format(date(from_unixtime(updated_at)) ,'%d-%m-%Y' )", $date_up]);


        return $dataProvider;
    }

}
