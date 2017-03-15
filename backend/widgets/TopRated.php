<?php

namespace plathir\smartblog\backend\widgets;

use yii\base\Widget;
use plathir\smartblog\helpers\PostHelper;
use Yii;

class TopRated extends Widget {

    public $posts_num = 10;
    public $Theme = 'default';
    public $title = 'Top Rated';
    public $selection_parameters = [];

    public function init() {
        parent::init();
        $this->selection_parameters = [
            'posts_num' => $this->posts_num,
            'Theme' => $this->Theme,
            'title' => $this->title,
        ];
    }

    public function run() {
        $this->registerClientAssets();
        $helper = new \plathir\smartblog\helpers\PostHelper();
        $topRated = $helper->getTopRated($this->posts_num);

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
