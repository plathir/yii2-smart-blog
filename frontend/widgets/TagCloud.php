<?php

namespace plathir\smartblog\frontend\widgets;

use yii\base\Widget;
use Yii;

class TagCloud extends Widget {

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
