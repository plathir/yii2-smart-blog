<?php

namespace plathir\smartblog\common\widgets;

use yii\base\Widget;

class TagsWidget extends Widget {

    public $tags;
    public $callbackUrl = '/blog/posts/tags';
    public $linkClass = 'label label-primary';
    public $title = 'Tags:';
    public $selection_parameters = [];

    public function init() {
        parent::init();
        $this->selection_parameters = [
          'title' => $this->title,
          'linkClass' =>  $this->linkClass    
        ];
    }

    public function run() {
        $this->registerClientAssets();
        return $this->render('tags_widget', [
                    'widget' => $this
        ]);
    }

    public function registerClientAssets() {
        $view = $this->getView();
        $assets = Asset::register($view);
    }

}
