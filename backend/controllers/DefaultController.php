<?php

namespace plathir\smartblog\backend\controllers;

use yii\web\Controller;

class DefaultController extends Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionNewpost() {

        return $this->render('newpost');
    }

}
