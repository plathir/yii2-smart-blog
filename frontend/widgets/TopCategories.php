<?php

namespace plathir\smartblog\frontend\widgets;

use plathir\smartblog\frontend\widgets\BaseWidget;

class TopCategories extends BaseWidget {

    public $category_num = 10;
    public $Theme = 'smart';
    public $title = 'Top Categories';
    public $selection_parameters = [];

    public function init() {
        parent::init();
        $this->selection_parameters = [
            'category_num' => $this->category_num,
            'Theme' => $this->Theme,
            'title' => $this->title,
        ];
    }

    public function run() {
        $this->registerClientAssets();
        $this->registerTranslations();
        $helper = new \plathir\smartblog\frontend\helpers\PostHelper();
        $topCategories = $helper->getTopCategories($this->category_num);

        return $this->render('top_categories', [
                    'topCategories' => $topCategories,
                    'widget' => $this
        ]);
    }
}
