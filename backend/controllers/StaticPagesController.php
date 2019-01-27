<?php

namespace plathir\smartblog\backend\controllers;

use Yii;
use plathir\smartblog\backend\models\StaticPages;
use plathir\smartblog\backend\models\StaticPagesLang;
use plathir\smartblog\backend\models\search\StaticPages_s;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StaticPagesController implements the CRUD actions for StaticPages model.
 */

/**
 * @property \plathir\smartblog\backend\Module $module
 *
 */
class StaticPagesController extends Controller {

    public function __construct($id, $module) {
        parent::__construct($id, $module);
        $this->layout = "main";
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['list', 'view'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['create',
                            'update',
                            'index',
                            'view',
                            'delete',
                            'get',
                            'deletetempfile',
                            'tagslist',
                            'browse-images',
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
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'browse-images' => [
                'class' => 'bajadev\ckeditor\actions\BrowseAction',
                'url' => '@MediaUrl/temp/images/blog/pages/',
                'path' => '@media/temp/images/blog/pages/',
            ],
            'upload-images' => [
                'class' => 'bajadev\ckeditor\actions\UploadAction',
                'url' => '@MediaUrl/temp/images/blog/pages/',
                'path' => '@media/temp/images/blog/pages/',
            ],
        ];

        return $actions;
    }

    /**
     * Lists all StaticPages models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StaticPages_s();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFilemanager() {

        return $this->render('filemanager');
    }

    public function actionList() {
        $searchModel = new StaticPages_s();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StaticPages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StaticPages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new StaticPages();
        $model->user_created = \Yii::$app->user->getId();
        $model->user_last_change = \Yii::$app->user->getId();
        $modelLang = new StaticPagesLang();
 


        if ($model->load(Yii::$app->request->post()) && $modelLang->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $model->descr = $modelLang->description;
               // $model->full_text = \yii\helpers\HtmlPurifier::process($model->full_text);
                if ($model->update()) {                    
                    $modelLang->id = $model->id;
                    $modelLang->lang = Yii::$app->language;
                    if ($modelLang->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        return $this->render('create', [
                                    'model' => $model,
                                    'modelLang' => $modelLang,
                        ]);
                    }
                } else {
                    return $this->render('create', [
                                'model' => $model,
                                'modelLang' => $modelLang,
                    ]);
                }
            } else {
                return $this->render('create', [
                            'model' => $model,
                            'modelLang' => $modelLang,
                ]);
            }
        } else {

            return $this->render('create', [
                        'model' => $model,
                        'modelLang' => $modelLang,
                        ''
            ]);
        }
    }

    /**
     * Updates an existing StaticPages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelLang = $this->findModelLang($id);
         

        if ($model->load(Yii::$app->request->post()) && $modelLang->load(Yii::$app->request->post())) {
            if (!isset($model->user_last_change)) {
                $model->user_last_change = \Yii::$app->user->getId();
            }
            $model->descr = $modelLang->description;
            if ($model->save()) {
                $modelLang->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                            'modelLang' => $modelLang,
                ]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'modelLang' => $modelLang,
            ]);
        }
    }

    /**
     * Deletes an existing StaticPages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the StaticPages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StaticPages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = StaticPages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('blog', 'The requested page does not exist.'));
        }
    }

        protected function findModelLang($id) {
        if (($model = StaticPagesLang::findOne(['id'=>$id , 'lang'=> Yii::$app->language ])) !== null) {
            return $model;
        } else {
           $model = new StaticPagesLang();
           $model->id = $id;
           $model->lang = Yii::$app->language;
           return $model;
        }
    }
}
