<?php

namespace plathir\smartblog\backend\widgets;

use yii\base\Widget;
use plathir\smartblog\helpers\PostHelper;
use Yii;

class TopRated extends Widget {

    public $posts_num = 10;
    public $Theme = 'default';

    public function init() {
        parent::init();
    }

    public function run() {
        $this->registerClientAssets();
        $helper = new \plathir\smartblog\helpers\PostHelper();
        $topRated = PostHelper::getTopRated($this->posts_num);

        return $this->render('top_rated_posts_widget', [
                    'posts' => $topRated,
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
