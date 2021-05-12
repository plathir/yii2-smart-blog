<?php

namespace plathir\smartblog\frontend\widgets;

use plathir\smartblog\frontend\widgets\BaseWidget;

class TagCloud extends BaseWidget {

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
        $this->registerTranslations();
        return $this->render('tag_cloud_widget',[
            'widget' => $this
        ]);
    }    
}
