<?php

namespace plathir\smartblog\backend\widgets;

use plathir\smartblog\backend\widgets\BaseWidget;

class TagCloud extends BaseWidget {

    public $Theme = 'smart';
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
}
