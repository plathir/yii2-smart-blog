<?php

namespace plathir\smartblog\frontend\widgets;

use plathir\smartblog\frontend\widgets\BaseWidget;

class CategoriesWithSubcategories extends BaseWidget {

    public $category_level = 0;
    public $category_id = '';
    public $Theme = 'smart';
    public $title = 'Top Categories';
    public $selection_parameters = [];
    public $typeView = 'media';
        

    public function init() {
        parent::init();
        $this->selection_parameters = [
            'category_level' => $this->category_level,
            'category_id' => $this->category_id,
            'Theme' => $this->Theme,
            'title' => $this->title,
            'typeView' => 'media'
        ];
    }

    public function run() {
        $this->registerClientAssets();
        $this->registerTranslations();
        $helper = new \plathir\smartblog\frontend\helpers\PostHelper();
        $Categories = $helper->getCategoriesWithSubCategories($this->category_level,$this->category_id);

        return $this->render('categories_with_subcategories', [
                    'Categories' => $Categories,
                    'widget' => $this
        ]);
    }
}
