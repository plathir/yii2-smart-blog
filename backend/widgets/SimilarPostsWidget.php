<?php

namespace plathir\smartblog\backend\widgets;

use yii\base\InvalidConfigException;
use Yii;
use plathir\smartblog\backend\widgets\BaseWidget;

class SimilarPostsWidget extends BaseWidget {

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
}
