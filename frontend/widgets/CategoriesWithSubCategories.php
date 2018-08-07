<?php

namespace plathir\smartblog\frontend\widgets;

use yii\base\Widget;
use yii\base\InvalidConfigException;
use plathir\smartblog\frontend\helpers\PostHelper;
use Yii;

class CategoriesWithSubcategories extends Widget {

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

    public function registerClientAssets() {
        $view = $this->getView();
        $assets = Asset::register($view);
    }

    public function getTemplatePath() {
        return '@vendor/plathir/yii2-smart-blog/frontend/themes/' . $this->Theme . '/views';
    }
    
    public function getViewPath() {
        return Yii::getAlias('@vendor') . '/plathir/yii2-smart-blog/frontend/widgets/themes/' . $this->Theme . '/views';
    }

    
    public function registerTranslations() {
        /*         * This registers translations for the widgets module * */
        Yii::$app->i18n->translations['blog'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => Yii::getAlias('@vendor/plathir/yii2-smart-blog/messages'),
        ];
    }

}
