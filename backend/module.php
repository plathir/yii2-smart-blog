<?php

namespace plathir\smartblog\backend;

class Module extends \yii\base\Module {

    public $controllerNamespace = 'plathir\smartblog\backend\controllers';
    public $ImagePath = '';
    public $ImageTempPath = '';
    public $ImagePathPreview = '';
    public $ImageTempPathPreview = '';
    public $KeyFolder = 'id';
    public $userModel = '';
    public $userNameField = '';

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
