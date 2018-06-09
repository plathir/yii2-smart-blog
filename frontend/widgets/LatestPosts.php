<?php

namespace plathir\smartblog\frontend\widgets;

use yii\base\Widget;
use Yii;

class LatestPosts extends Widget {

    public $latest_num = 10;
    public $Theme = 'smart';
    public $title = 'Latest Posts';
    public $selection_parameters = [];
    public $typeView = 'media';
    public $html = 'This is a test';

    public function init() {
        parent::init();
        $this->selection_parameters = [
            'latest_num' => 10,
            'Theme' => 'smart',
            'typeView' => 'media'
        ];
    }

    public function run() {
        $this->registerClientAssets();
        $this->registerTranslations();
        $helper = new \plathir\smartblog\frontend\helpers\PostHelper();
        $posts = $helper->getLatestPosts($this->latest_num);

        return $this->render('latest_posts_widget', [
                    'posts' => $posts,
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

        public function getTemplatePath() {
        return '@vendor/plathir/yii2-smart-blog/frontend/themes/' . $this->Theme . '/views';
    }
    
    public function getFrontEndPath() {
        return Yii::getAlias('@vendor') . '/plathir/yii2-smart-blog/frontend/themes/' . $this->Theme . '/views';
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
