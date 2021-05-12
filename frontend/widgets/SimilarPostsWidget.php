<?php

namespace plathir\smartblog\frontend\widgets;

use yii\base\InvalidConfigException;
use \plathir\smartblog\frontend\helpers\PostHelper;
use plathir\smartblog\frontend\widgets\BaseWidget;

class SimilarPostsWidget extends BaseWidget {

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
}
