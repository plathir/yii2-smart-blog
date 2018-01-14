<?php

namespace plathir\smartblog\backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use plathir\smartblog\backend\models\Categorytree as Category;

/**
 * Posts_s represents the model behind the search form about `app\models\Posts`.
 */
class Category_s extends Category {
    /**
     * @inheritdoc
     */
//    public function rules() {
//        return [
//            [['id'], 'integer'],
//            [['name','description'],'string'],
//         ];
//    }

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
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ]);

//        $query->andFilterWhere(['like', 'description', $this->description])
//                ->andFilterWhere(['like', 'intro_text', $this->intro_text])
//                ->andFilterWhere(['like', 'full_text', $this->full_text])
//                ->andFilterWhere(['like', 'post_image', $this->post_image])
//                ->andFilterWhere(['like', "date_format(date(from_unixtime(created_at)) ,'%d-%m-%Y' )", $date_cr])
//                ->andFilterWhere(['like', "date_format(date(from_unixtime(updated_at)) ,'%d-%m-%Y' )", $date_up]);
//

        return $dataProvider;
    }

}
