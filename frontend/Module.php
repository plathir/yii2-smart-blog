<?php

namespace plathir\smartblog\frontend;

use yii\helpers\Url;
use Yii;

class Module extends \yii\base\Module {

    public $controllerNamespace = 'plathir\smartblog\frontend\controllers';
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
    public $Theme = 'smart';
    public $editor = 'CKEditor';
    public $image_width = 400;             // Widget Select Crop Image size
    public $image_height = 300;            // Widget Select Crop Image size 
    public $crop_image_width = 400;        // Widget Crop Area size
    public $crop_image_height = 300;       // Widget Crop Area size
    public $store_image_width = 800;       // image store size
    public $store_image_height = 600;      // image store size
    public $store_thumbnail_width = 266;   // thumbnail store size
    public $store_thumbnail_height = 200;  // thumbnail store size

    public function init() {
        $path = Yii::getAlias('@vendor') . '/plathir/yii2-smart-blog/frontend/themes/' . $this->Theme . '/views';
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
                    //'nodeView' => '@kvtree/views/_form'
                    'nodeView' => '/categorytree/_form'
                ]
            ]
        ];

        parent::init();
        $this->registerTranslations();

        // custom initialization code goes here
    }

    public function registerTranslations() {
        /*         * This registers translations for the widgets module * */
        Yii::$app->i18n->translations['blog'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => Yii::getAlias('@vendor/plathir/yii2-smart-blog/messages'),
        ];
    }

}
