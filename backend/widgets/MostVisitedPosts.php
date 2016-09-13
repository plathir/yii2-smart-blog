<?php

namespace plathir\smartblog\backend\widgets;

use yii\base\Widget;
use yii\base\InvalidConfigException;
use plathir\smartblog\helpers\PostHelper;
use Yii;

class MostVisitedPosts extends Widget {

    public $posts_num = 10;
    public $Theme = false;

    public function init() {
        parent::init();
    }

    public function run() {
        $this->registerClientAssets();
        $helper = new \plathir\smartblog\helpers\PostHelper();
        $posts = PostHelper::getMostVisitedPosts($this->posts_num);

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
        return Yii::getAlias('@vendor') . '/plathir/yii2-smart-blog/backend/widgets/themes/' . $this->Theme . '/views';
    }

}
