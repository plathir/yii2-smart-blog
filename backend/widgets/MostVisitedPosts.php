<?php

namespace plathir\smartblog\backend\widgets;

use plathir\smartblog\backend\widgets\BaseWidget;

class MostVisitedPosts extends BaseWidget {

    public $posts_num = 10;
    public $Theme = 'smart';
    public $title = 'Most Visited Posts';
    public $selection_parameters = [];

    public function init() {
        parent::init();
        $this->selection_parameters  = [
          'posts_num' => $this->posts_num,  
          'Theme' => $this->Theme,  
          'title' => $this->title,  
        ];
    }

    public function run() {
        $this->registerClientAssets();
        $helper = new \plathir\smartblog\backend\helpers\PostHelper();
        $posts = $helper->getMostVisitedPosts($this->posts_num);

        return $this->render('most_visited_posts_widget', [
                    'posts' => $posts,
                    'widget' => $this
        ]);
    }
}
