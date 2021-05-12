<?php

namespace plathir\smartblog\backend\widgets;

use plathir\smartblog\backend\widgets\BaseWidget;

class LatestPosts extends BaseWidget {

    public $latest_num = 10;
    public $Theme = 'default';
    public $title = 'Latest Posts';
    public $selection_parameters = [];

    public function init() {
        parent::init();
        $this->selection_parameters = [
          'latest_num' => 10,  
          'Theme' => 'default',  
        ];
    }

    public function run() {
        $this->registerClientAssets();
        $helper = new \plathir\smartblog\backend\helpers\PostHelper();
        $posts = $helper->getLatestPosts($this->latest_num);

        return $this->render('latest_posts_widget', [
                    'posts' => $posts,
                    'widget' => $this
        ]);
    }
}
