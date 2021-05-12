<?php

namespace plathir\smartblog\backend;

use yii\web\AssetBundle;

class blogAsset extends AssetBundle {

    public $js = [
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function init() {       
        $this->setSourcePath('@vendor/plathir/yii2-smart-blog/common/assets');
        parent::init();
    }

    protected function setSourcePath($path) {
        if (empty($this->sourcePath)) {
            $this->sourcePath = $path;
        } else {
            $this->sourcePath = '';
        }
    }

}
