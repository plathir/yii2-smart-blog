<?php

namespace plathir\smartblog\backend\widgets;

use plathir\smartblog\backend\widgets\BaseWidget;

class TopAuthors extends BaseWidget {

    public $authors_num = 10;
    public $Theme = false;
    public $title = 'Top Authors';
    public $selection_parameters = [];

    public function init() {
        parent::init();
        $this->selection_parameters = [
          'authors_num' => $this->authors_num,  
          'Theme' => $this->Theme,  
          'title' => $this->title,  
        ];
    }

    public function run() {
        $this->registerClientAssets();
        $helper = new \plathir\smartblog\backend\helpers\PostHelper();
        $topAuthors = $helper->getTopAuthors($this->authors_num);

        return $this->render('top_authors', [
                    'topAuthors' => $topAuthors,
                    'widget' => $this
        ]);
    }
}
