<?php

namespace plathir\smartblog\backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use plathir\smartblog\backend\models\Carousel;
use plathir\smartblog\backend\models\CarouselItems;
use plathir\smartblog\backend\models\search\CarouselSearch;
use plathir\smartblog\backend\models\Posts;

/**
 * CarouselController implements the CRUD actions for Carousel model.
 * @property apps\posts\backend\Module $module
 */
class CarouselController extends Controller {

    public function __construct($id, $module) {
        parent::__construct($id, $module);
               $this->layout = "main";
    }    
    
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Carousel models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CarouselSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Carousel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        \yii\helpers\Url::remember();
        $item = new CarouselItems();

        if ($item->load(Yii::$app->request->post())) {

            $post = Posts::findOne($item->post_id);
//            echo 'In'. $item->post_id;
//            print_r($item);
//            die();   
            
            if ($post) {
                $item->carousel_id = $id;
                if ($item->save()) {

                    } else {
                        
                }
            } else {

            }
        }
        
        $item = new CarouselItems();
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'newItem' => $item,
        ]);
    }

    /**
     * Creates a new Carousel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Carousel();
        $model->created_by = \Yii::$app->user->getId();
        $model->updated_by = \Yii::$app->user->getId();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Carousel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->updated_by = \Yii::$app->user->getId();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Carousel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteitem($id) {
        $this->findModelItem($id)->delete();
        return $this->goBack();
    }

    /**
     * Finds the Carousel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Carousel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Carousel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelItem($id) {
        if (($model = CarouselItems::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
