<?php

namespace plathir\smartblog\frontend\widgets;

use yii\base\Widget;
use yii\base\InvalidConfigException;
use \plathir\smartblog\frontend\helpers\PostHelper;
use Yii;

class SimilarPostsWidget extends Widget {

    public $postID;
    public $Theme = 'smart';
    public $typeView = 'media';

    public function init() {
        parent::init();

        if ($this->postID === null) {
            throw new InvalidConfigException('Recipe ID cannot be null !');
        }
    }

    public function run() {
        $this->registerClientAssets();
        $helper = new PostHelper();
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

    public function getViewPath() {
        return Yii::getAlias('@vendor') . '/plathir/yii2-smart-blog/frontend/widgets/themes/' . $this->Theme . '/views';
    }

    public function getTemplatePath() {
        return '@vendor/plathir/yii2-smart-blog/frontend/themes/' . $this->Theme . '/views';
    }

}
