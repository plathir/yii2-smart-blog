<?php
namespace plathir\smartblog\backend\controllers;

use yii\web\Controller;
use Yii;

/**
 * @property \plathir\smartblog\backend\Module $module
 *
 */
class DefaultController extends Controller {

    use \plathir\smartblog\backend\traits\ModuleTrait;

    public function __construct($id, $module) {
        parent::__construct($id, $module);
        $this->layout = "main";
    }

    public function actionIndex() {
        return $this->render('index', ['Theme' => $this->module->Theme]
        );
    }

    public function actionIndex1() {
        return $this->render('index1', ['Theme' => $this->module->Theme]
        );
    }

    public function actionNewpost() {

        return $this->render('newpost');
    }

    public function actionLoadxml() {
        $filename = Yii::getAlias('@vendor/plathir/yii2-smart-blog/migrations/Data.xml');
        $xml = file_get_contents($filename);

        $reader = new \plathir\apps\components\migration\ReadDataXML();
        $data = $reader->readxml($xml);
        return $this->render('loadxml', ['xml' => $data]);
    }

}
