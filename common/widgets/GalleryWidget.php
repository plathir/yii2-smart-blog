<?php

namespace plathir\smartblog\common\widgets;

use yii\base\Widget;

class GalleryWidget extends Widget {

    public $title = 'Gallery:';
    public $galleryItems = '';
    public $previewUrl = '';
    public $imagePath = '';

    public function init() {
        parent::init();
    }

    public function run() {
        $this->registerClientAssets();
        return $this->render('gallery_widget', [
                    'widget' => $this
        ]);
    }

    public function registerClientAssets() {
        $view = $this->getView();
        $assets = Asset::register($view);
    }

}
