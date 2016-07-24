<?php

namespace plathir\smartblog\backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @property \plathir\smartblog\Module $module
 *
 */
class CategoryController extends Controller {

    public function __construct($id, $module) {
        parent::__construct($id, $module);
    }

    public function behaviors() {
        parent::behaviors();
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                //      'uploadphoto' => ['post'],
                //      'deletetempfile' => ['post'],
                //   'remove' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [

                    [
                        'actions' => [
                            'index',
                            'uploadphoto',
//                            'deletetempfile',
                            'update',
//                            'test',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

        public function actions() {

        $actions = [
            'uploadphoto' => [
                'class' => '\plathir\cropper\actions\UploadAction',
                'width' => 600,
                'height' => 600,
                'temp_path' => $this->module->CategoryImageTempPath,
            ],
            'deletetempfile' => [
                'class' => '\plathir\upload\actions\FileDeleteAction',
                'uploadDir' => $this->module->CategoryImageTempPath,
            ],
        ];
        return $actions;
    }
    public function actionIndex() {
        $searchModel = new \plathir\smartblog\backend\models\search\Category_s();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
            
        ]);
    }

    public function actionUpdate($id) {
//        $model = $this->findModel($id);
//              return $this->render('update', [
//                    'model' => $model
//        ]);
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    protected function findModel($id) {
        if (($model = \plathir\smartblog\backend\models\Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
