<?php

namespace plathir\smartblog\common\widgets;

use yii\base\Widget;
use justinvoelker\tagging\TaggingQuery;

class TagCloudWidget extends Widget {

    public $tags;
    public $callbackUrl = 'posts/tags';
    public $title = 'Tag Cloud';

    public function init() {
        parent::init();
    }

    public function run() {
        $this->registerClientAssets();
        $query = new TaggingQuery;
        $this->tags = $query
                ->select('tags')
                ->from('{{%posts}}')
                ->getTags();

        return $this->render('tag_cloud_widget', [
                    'widget' => $this
        ]);
    }

    
    public function registerClientAssets() {
        $view = $this->getView();
        $assets = Asset::register($view);
    }

}
