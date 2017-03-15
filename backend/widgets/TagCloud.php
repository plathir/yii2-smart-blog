<?php

namespace plathir\smartblog\backend\widgets;

use yii\base\Widget;
use Yii;

class TagCloud extends Widget {

    public $Theme = 'default';
    public $title = 'Tag Cloud';
    public $selection_parameters = [];

    public function init() {
        parent::init();
        $this->selection_parameters = [
           'Theme' => $this->Theme,  
           'title' => $this->title,  
        ];
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
