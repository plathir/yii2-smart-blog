<?php

namespace plathir\smartblog\backend\widgets;

use yii\base\Widget;
use Yii;

class TagCloud extends Widget {

    public $Theme = 'default';
    public $title = 'Tag Cloud';

    public function init() {
        parent::init();
    }

    public function run() {
        $this->registerClientAssets();
        return $this->render('tag_cloud_widget',[
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
