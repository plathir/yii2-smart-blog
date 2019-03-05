<?php
namespace plathir\smartblog\backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use plathir\smartblog\backend\models\Posts as Posts;
use Yii;

/**
 * Posts_s represents the model behind the search form about `app\models\Posts`.
 */
class Posts_s extends Posts {

    public $description;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'user_created', 'user_last_change', 'publish'], 'integer'],
            [['description', 'intro_text', 'full_text', 'post_image', 'created_at', 'updated_at', 'tags'], 'safe'],
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

        if ($this->category) {
            $categoryArray = explode(",", $this->category);
            $query->andFilterWhere(['in', 'category', $categoryArray]);
        }

        $query->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'intro_text', $this->intro_text])
                ->andFilterWhere(['like', 'full_text', $this->full_text])
                ->andFilterWhere(['like', 'post_image', $this->post_image])
                ->andFilterWhere(['like', "( FROM_UNIXTIME(" . $this->tableName() . ".created_at, '" . Yii::$app->settings->getSettings('DBShortDateFormat') . " %h:%i:%s %p' ))", $this->created_at])
                ->andFilterWhere(['like', "( FROM_UNIXTIME(" . $this->tableName() . ".updated_at, '" . Yii::$app->settings->getSettings('DBShortDateFormat') . " %h:%i:%s %p' ))", $this->updated_at]);

        return $dataProvider;
    }

}
