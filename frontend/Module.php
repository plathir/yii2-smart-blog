<?php

namespace plathir\smartblog\frontend;

use yii\helpers\Url;
use Yii;
use plathir\smartblog\backend\blogAsset;

class Module extends \yii\base\Module {

    use \kartik\base\TranslationTrait;

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
    public $assetBundle = '';
    public $themePath = '';

    public function init() {

   //     echo $this->getBasePath();
        $themeHelper = new \frontend\helpers\ThemesHelper();
        $this->themePath = $themeHelper->ModuleThemePath('blog', __FILE__);
               
        $this->setViewPath($this->themePath);

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
                'class' => 'plathir\settings\backend\Module',
                'modulename' => 'blog'
            ],
        ];

        $this->assetBundle = blogAsset::register(Yii::$app->view);
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
