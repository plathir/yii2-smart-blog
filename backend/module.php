<?php

namespace plathir\smartblog\backend;

use yii\helpers\Url;
use Yii;

class Module extends \yii\base\Module {

    use \kartik\base\TranslationTrait;

    public $controllerNamespace = 'plathir\smartblog\backend\controllers';
    public $mediaUrl = '';
    public $mediaPath = '';
    public $ImagePath = '';
    public $ImageTempPath = '';
    public $ImagePathPreview = '';
    public $ImageTempPathPreview = '';
    public $CategoryImagePath = '';
    public $CategoryImageTempPath = '';
    public $CategoryImagePathPreview = '';
    public $CategoryImageTempPathPreview = '';
    public $KeyFolder = 'id';
    public $userModel = '';
    public $userNameField = '';
    public $Theme = 'default';

    public function init() {
        
        // The following three lines initialize i18n for kvtree
        $dir = '@vendor/kartik-v/yii2-tree-manager/messages';
        $cat = 'kvtree';
        $this->initI18N($dir, $cat);
        
        $path = Yii::getAlias('@vendor') . '/plathir/yii2-smart-blog/backend/themes/' . $this->Theme . '/views';
        $this->setViewPath($path);

        $this->controllerMap = [
            'elfinder' => [
                'class' => 'mihaildev\elfinder\Controller',
                'access' => ['@'],
                'disabledCommands' => ['netmount'],
                'roots' => [
                    [
                        'baseUrl' => $this->mediaUrl,
                        'basePath' => $this->mediaPath,
                        'path' => '',
                        'name' => 'Global'
                    ],
                ],
            ],
        ];

        $this->modules = [
            'settings' => [
                'class' => 'plathir\settings\Module',
                'modulename' => 'blog'
            ],
            'treemanager' => [
                'class' => '\kartik\tree\Module',
                'treeViewSettings' => [
                    'nodeActions' => [
                        \kartik\tree\Module::NODE_MANAGE => Url::to(['/blog/categorytree/manage']),
                        \kartik\tree\Module::NODE_SAVE => Url::to(['/blog/categorytree/save']),
                        \kartik\tree\Module::NODE_REMOVE => Url::to(['/blog/categorytree/remove']),
                        \kartik\tree\Module::NODE_MOVE => Url::to(['/blog/categorytree/move']),
                    ],
                  //  'nodeView' => '@kvtree/views/_form'
                'nodeView' => '/categorytree/_form'
                ],
            ]
        ];
        // custom initialization code goes here
    }

}
