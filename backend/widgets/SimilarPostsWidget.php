<?php

namespace plathir\smartblog\backend\widgets;

use yii\base\Widget;
use yii\base\InvalidConfigException;
use Yii;

class SimilarPostsWidget extends Widget {

    public $postID;
    public $Theme = 'smart';    
    public $selection_parameters = [];

    public function init() {
        parent::init();

        if ($this->postID === null) {
            throw new InvalidConfigException('PostID cannot be null !');
        }
        
        $this->selection_parameters = [
            'postID' => ''
        ];
        
    }

    public function run() {
        $this->registerClientAssets();
        $helper = new \plathir\smartblog\backend\helpers\PostHelper();
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
        return Yii::getAlias('@vendor') . '/plathir/yii2-smart-blog/backend/widgets/themes/' . $this->Theme . '/views';
    }

    public function getTemplatePath() {
        return '@vendor/plathir/yii2-smart-blog/backend/themes/' . $this->Theme . '/views';
    }
    
}
