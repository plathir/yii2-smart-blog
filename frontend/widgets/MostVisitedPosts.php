<?php

namespace plathir\smartblog\frontend\widgets;

use yii\base\Widget;
use yii\base\InvalidConfigException;
use plathir\smartblog\helpers\PostHelper;
use Yii;

class MostVisitedPosts extends Widget {

    public $posts_num = 10;
    public $Theme = 'default';
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
        $helper = new \plathir\smartblog\helpers\PostHelper();
        $posts = $helper->getMostVisitedPosts($this->posts_num);

        return $this->render('most_visited_posts_widget', [
                    'posts' => $posts,
                    'widget' => $this
        ]);
    }

    public function registerClientAssets() {
        $view = $this->getView();
        $assets = Asset::register($view);
    }

    public function getViewPath() {
        return Yii::getAlias('@vendor') . '/plathir/yii2-smart-blog/frontend/widgets/themes/' . $this->Theme . '/views';
    }

}
