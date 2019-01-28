<?php

namespace plathir\smartblog\backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use plathir\smartblog\backend\models\StaticPages as StaticPages;

/**
 * Posts_s represents the model behind the search form about `app\models\Posts`.
 */
class StaticPages_s extends StaticPages {
     public $description;
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'user_created', 'user_last_change', 'publish'], 'integer'],
            [['description'], 'safe'],
            [['full_text'], 'safe'],
            [['intro_text'], 'safe'],
            [['created_at', 'updated_at', 'tags'], 'safe'],
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
        $query = StaticPages::find();
        $query->joinWith(['langtext']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        $query->andFilterWhere([
            'id' => $this->id,
            'user_created' => $this->user_created,
            'user_last_change' => $this->user_last_change,
            'publish' => $this->publish,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
              ->andFilterWhere(['like', 'intro_text', $this->intro_text])
              ->andFilterWhere(['like', 'full_text', $this->full_text]);

        return $dataProvider;
    }

}
