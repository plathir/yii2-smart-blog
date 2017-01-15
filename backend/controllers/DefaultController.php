<?php

namespace plathir\smartblog\backend\controllers;

use yii\web\Controller;

/**
 * @property \plathir\smartblog\backend\Module $module
 *
 */
class DefaultController extends Controller {

    use \plathir\smartblog\backend\traits\ModuleTrait;

    public function __construct($id, $module) {
        parent::__construct($id, $module);
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

}
