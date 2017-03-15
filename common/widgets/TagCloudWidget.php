<?php

namespace plathir\smartblog\common\widgets;

use yii\base\Widget;
use justinvoelker\tagging\TaggingQuery;

class TagCloudWidget extends Widget {

    public $tags;
    public $callbackUrl = '/blog/posts/tags';
    public $title = 'Tag Cloud';
    public $selection_parameters = [];

    public function init() {
        parent::init();
        $this->selection_parameters = [
            'title' => $this->title
        ];
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
