<?php

namespace plathir\smartblog\common\widgets;

use yii\base\Widget;
use yii\base\InvalidConfigException;

class SimilarPostsWidget extends Widget {

    public $postID;

    public function init() {
        parent::init();

        if ($this->postID === null) {
            throw new InvalidConfigException('PostID cannot be null !');
        }
    }

    public function run() {
        $this->registerClientAssets();
        $helper = new \plathir\smartblog\helpers\PostHelper();
        $posts = $helper->findSimilarPosts($this->postID);

        return $this->render('similar_posts_widget', [
                    'posts' => $posts,
                    'widget' => $this
        ]);
    }

    public function registerClientAssets() {
        $view = $this->getView();
        $assets = Asset::register($view);
    }

}
