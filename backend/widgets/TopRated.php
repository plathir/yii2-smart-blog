<?php

namespace plathir\smartblog\backend\widgets;

use plathir\smartblog\backend\widgets\BaseWidget;

class TopRated extends BaseWidget {

    public $posts_num = 10;
    public $Theme = 'default';
    public $title = 'Top Rated';
    public $selection_parameters = [];

    public function init() {
        parent::init();
        $this->selection_parameters = [
            'posts_num' => $this->posts_num,
            'Theme' => $this->Theme,
            'title' => $this->title,
        ];
    }

    public function run() {
        $this->registerClientAssets();
        $helper = new \plathir\smartblog\backend\helpers\PostHelper();
        $topRated = $helper->getTopRated($this->posts_num);

        return $this->render('top_rated_posts_widget', [
                    'posts' => $topRated,
                    'widget' => $this
        ]);
    }

}
