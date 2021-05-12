<?php

namespace plathir\smartblog\frontend\widgets;

use yii\base\Widget;
use plathir\smartblog\frontend\models\search\Posts_s;
use plathir\smartblog\frontend\models\Carousel;
use Yii;
use plathir\smartblog\frontend\widgets\BaseWidget;

class CarouselPosts extends BaseWidget {

    public $tags;
    public $posts = '';
    public $carousel_id = '';
    public $height = '300px';
    public $Theme = 'default';
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

        return $this->render('carousel_posts_widget', [
                    'widget' => $this,
                    'posts' => $listPosts
        ]);
    }

}
