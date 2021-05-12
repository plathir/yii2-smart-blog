<?php

namespace plathir\smartblog\backend\widgets;

use yii\base\Widget;
use plathir\smartblog\backend\models\search\Posts_s;
use plathir\smartblog\backend\models\Carousel;
use Yii;
use plathir\smartblog\backend\widgets\BaseWidget;

class CarouselPosts extends BaseWidget {

    public $tags;
    public $posts = '';
    public $carousel_id = '';
    public $height = '300px';
    public $Theme = 'smart';
    public $title = '';
    public $selection_parameters = [];

    public function init() {
        parent::init();
        $this->selection_parameters = [
            'posts' => $this->posts,
            'carousel_id' => $this->carousel_id,
            'height' => $this->height,
            'Theme' => $this->Theme,
        ];
    }

    public function run() {
        $this->registerClientAssets();
        $listPosts = [];
        if ($this->posts) {
            $listPostsNum = explode(',', $this->posts);
            $listPosts = [];
            foreach ($listPostsNum as $postNum) {
                $listPosts[] = Posts_s::findOne($postNum);
            }
        };

        if ($this->carousel_id) {
            $carousel = Carousel::findOne($this->carousel_id);
            if ($carousel) {
                foreach ($carousel->carouselItems as $item) {
                    $listPosts[] = Posts_s::findOne($item->post_id);
                }
            }
        }
//        echo '<pre>';

//        print_r($listPosts);
//        echo '</pre>';
//        die();

        return $this->render('carousel_posts_widget', [
                    'widget' => $this,
                    'posts' => $listPosts
        ]);
    }

    public function registerClientAssets() {
        $view = $this->getView();
        $assets = Asset::register($view);
    }

}
