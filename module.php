<?php

namespace plathir\smartblog;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'plathir\smartblog\controllers';

    public function init()
    {
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