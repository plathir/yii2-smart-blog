<?php

namespace plathir\smartblog\backend\widgets;

use yii\base\Widget;
use yii\base\InvalidConfigException;
use plathir\smartblog\helpers\PostHelper;
use Yii;

class TopAuthors extends Widget {

    public $authors_num = 10;
    public $Theme = false;
    public $title = 'Top Authors';

    public function init() {
        parent::init();
    }

    public function run() {
        $this->registerClientAssets();
        $helper = new \plathir\smartblog\helpers\PostHelper();
        $topAuthors = $helper->getTopAuthors($this->authors_num);

        return $this->render('top_authors', [
                    'topAuthors' => $topAuthors,
                    'widget' => $this
        ]);
    }

    public function registerClientAssets() {
        $view = $this->getView();
        $assets = Asset::register($view);
    }

    public function getViewPath() {
        return Yii::getAlias('@vendor') . '/plathir/yii2-smart-blog/backend/widgets/themes/' . $this->Theme . '/views';
    }

}
