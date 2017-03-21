<?php

namespace plathir\smartblog\frontend\widgets;

use yii\base\Widget;
use yii\base\InvalidConfigException;
use plathir\smartblog\helpers\PostHelper;
use Yii;

class TopAuthors extends Widget {

    public $authors_num = 10;
    public $Theme = false;
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
        return Yii::getAlias('@vendor') . '/plathir/yii2-smart-blog/frontend/widgets/themes/' . $this->Theme . '/views';
    }

}
