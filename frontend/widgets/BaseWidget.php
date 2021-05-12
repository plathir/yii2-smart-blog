<?php

namespace plathir\smartblog\frontend\widgets;

use yii\base\Widget;
use \common\helpers\ThemesHelper;
use Yii;

class BaseWidget extends Widget {

    public $Theme = 'smart';

    public function registerClientAssets() {
        $view = $this->getView();
        $assets = Asset::register($view);
    }

     public function getViewPath() {
        $helper = new ThemesHelper();
        $path = $helper->WidgetThemePath('blog', 'frontend', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . $this->Theme . DIRECTORY_SEPARATOR . 'views');
        return $path;
        
    }

    public function getTemplatePath() {
        $helper = new ThemesHelper();
        $path = $helper->ModuleThemePath('blog', 'frontend', '@vendor/plathir/yii2-smart-blog/frontend/themes/' . $this->Theme, true);
        
        $path = $path . '/views';
        //$path = '@realAppPath/themes/site/smart/module/blog/views';
        return $path;
    }

    public function getFrontEndPath() {
        $helper = new ThemesHelper();
        $path = $helper->ModuleThemePath('blog', 'frontend', '@vendor/plathir/yii2-smart-blog/frontend/themes/' . $this->Theme);
        $path = $path.  '/views';
        return $path;
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
