<?php

namespace plathir\smartblog\backend\widgets;

use yii\base\Widget;
use \common\helpers\ThemesHelper;

class BaseWidget extends Widget {

    public $Theme = 'smart';

    public function registerClientAssets() {
        $view = $this->getView();
        $assets = Asset::register($view);
    }

    public function getViewPath() {
        $helper = new ThemesHelper();
        return $helper->WidgetThemePath('blog', 'backend', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . $this->Theme . DIRECTORY_SEPARATOR . 'views');
    }

}
