<?php

namespace plathir\smartblog\common\widgets;

use yii\base\Widget;

class TagsWidget extends Widget {

    public $tags;
    public $callbackUrl = 'posts/tags';
    public $linkClass = 'label label-primary';
    public $title = 'Tags:';

    public function init() {
        parent::init();
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
