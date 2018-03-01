<?php

namespace plathir\smartblog\frontend\widgets;

use yii\base\Widget;
use yii\base\InvalidConfigException;
use plathir\smartblog\helpers\PostHelper;
use Yii;

class TopCategories extends Widget {

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
        $helper = new \plathir\smartblog\helpers\PostHelper();
        $topCategories = $helper->getTopCategories($this->category_num);

        return $this->render('top_categories', [
                    'topCategories' => $topCategories,
                    'widget' => $this
        ]);
    }

    public function registerClientAssets() {
        $view = $this->getView();
        $assets = Asset::register($view);
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
