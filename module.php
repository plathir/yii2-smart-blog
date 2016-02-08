<?php

namespace plathir\smartblog;

class Module extends \yii\base\Module {

    public $controllerNamespace = 'plathir\smartblog\controllers';
    public $ImagePath = '@media/images/blog/posts';
    public $ImageTempPath = '@media/temp/images/blog/posts';
    public $ImagePathPreview = '/my-yii-adv/frontend/web/media/images/blog/posts';
    public $ImageTempPathPreview = '/my-yii-adv/frontend/web/media/temp/images/blog/posts';
    public $KeyFolder = 'id';

    public function init() {
        $this->modules = [
            'settings' => [
                'class' => 'plathir\settings\Module',
                'modulename' => 'blog'
            ],
        ];

        parent::init();

        // custom initialization code goes here
    }

}
