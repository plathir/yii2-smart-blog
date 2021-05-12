<?php

namespace plathir\smartblog\frontend\widgets;

use plathir\smartblog\frontend\widgets\BaseWidget;

class TopAuthors extends BaseWidget {

    public $authors_num = 10;
    public $Theme = 'smart';
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
        $this->registerTranslations();
        $helper = new \plathir\smartblog\frontend\helpers\PostHelper();
        $topAuthors = $helper->getTopAuthors($this->authors_num);

        return $this->render('top_authors', [
                    'topAuthors' => $topAuthors,
                    'widget' => $this
        ]);
    }
}
