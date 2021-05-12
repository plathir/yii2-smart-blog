<?php

namespace plathir\smartblog\frontend\widgets;

use plathir\smartblog\frontend\widgets\BaseWidget;

class MostVisitedPosts extends BaseWidget {

    public $posts_num = 10;
    public $Theme = 'smart';
    public $title = 'Most Visited Posts';
    public $typeView = 'media';
    public $selection_parameters = [];

    public function init() {
        parent::init();
        $this->selection_parameters = [
            'posts_num' => $this->posts_num,
            'Theme' => $this->Theme,
            'title' => $this->title,
            'typeView' => 'media'
        ];
    }

    public function run() {
        $this->registerClientAssets();
        $this->registerTranslations();
        $helper = new \plathir\smartblog\frontend\helpers\PostHelper();
        $posts = $helper->getMostVisitedPosts($this->posts_num);

        return $this->render('most_visited_posts_widget', [
                    'posts' => $posts,
                    'widget' => $this
        ]);
    }

}
