<?php

namespace plathir\smartblog\common\widgets;

use Yii;
use yii\base\Widget;
use plathir\smartblog\common\models\Posts;
use plathir\smartblog\common\models\PostsRating;

class RatingWidget extends Widget {

    public $post_id;
    public $onlyDisplay = false;

    public function init() {
        parent::init();
    }

    public function run() {
        $this->registerClientAssets();
        //if (Yii::$app->request->isPjax) {
            $post = $this->findModel($this->post_id);
            if ($post) {
                $rating = $this->findRatingModel($this->post_id);
                if ($rating->load(Yii::$app->request->post())) {
                    if (isset($rating->temprate)) {
                        $rating->rating_sum = $rating->rating_sum + $rating->temprate;
                        $rating->rating_count = $rating->rating_count + 1;
                        $rating->last_ip = Yii::$app->request->getUserIP();
                        $rating->save();
                        $rating = $this->findRatingModel($this->post_id);

                        return $this->render('rating_widget', [
                                    'widget' => $this,
                                    'model' => $post,
                                    'ratemodel' => $rating,
                        ]);
                    }

                    return $this->render('rating_widget', [
                                'widget' => $this,
                                'model' => $post,
                                'ratemodel' => $this->findRatingModel($this->post_id),
                    ]);
                } else {

                    return $this->render('rating_widget', [
                                'widget' => $this,
                                'model' => $post,
                                'ratemodel' => $rating,
                    ]);
                }
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }

    }

    protected function findModel($id) {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findRatingModel($id) {
        if (($post_rating = PostsRating::findOne($id)) !== null) {
            $post_rating->temprate = $post_rating->temprateval;
            return $post_rating;
        } else {
            $post_rating = new PostsRating();
            $post_rating->post_id = $id;
            $post_rating->temprate = 0;
            $post_rating->rating_sum = 0;
            $post_rating->rating_count = 0;
           // $post_rating->last_ip = Yii::$app->request->getUserIP();
            return $post_rating;
        }
    }

    public function registerClientAssets() {
        $view = $this->getView();
        $assets = Asset::register($view);
    }

}
