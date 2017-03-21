<?php

namespace plathir\smartblog\backend\controllers;

use Yii;
use plathir\smartblog\backend\models\Posts;
use plathir\smartblog\backend\models\search\Posts_s;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use plathir\smartblog\backend\models\PostsRating;
use plathir\smartblog\common\models\Tags;
use plathir\smartblog\common\models\PostsTags;

/**
 * PostsController implements the CRUD actions for Posts model.
 */

/**
 * @property \plathir\smartblog\backend\Module $module
 *
 */
class PostsController extends Controller {

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
                    'clipupl' => ['post'],
                    'uploadphoto' => ['post'],
                    'uploadfile' => ['post'],
                    'deletetempfile' => ['post'],
                //     'tagslist' => ['post']
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
                            'image-upload',
                            'file-upload',
                            'clipupl',
                            'uploadphoto',
                            'uploadfile',
                            'deletetempfile',
                            'tags',
                            'tagslist',
                            'browse-images',
                            'upload-images',
                            'filemanager',
                            'userposts',
                            'postrate',
                            'tagsrebuild',
                            'category',
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
            //Upload cropped image into temp directory
            'uploadphoto' => [
                'class' => '\plathir\cropper\actions\UploadAction',
                'width' => 600,
                'height' => 600,
                'thumbnail' => true,
                'temp_path' => $this->module->ImageTempPath,
            ],
            'uploadfile' => [
                'class' => '\plathir\upload\actions\FileUploadAction',
                'uploadDir' => $this->module->ImageTempPath,
                'thumbnail' => true,
            ],
            'deletetempfile' => [
                'class' => '\plathir\upload\actions\FileDeleteAction',
                'uploadDir' => $this->module->ImageTempPath,
            ],
            'browse-images' => [
                'class' => 'bajadev\ckeditor\actions\BrowseAction',
                'url' => '@MediaUrl/temp/images/blog/posts/',
                'path' => '@media/temp/images/blog/posts/',
            ],
            'upload-images' => [
                'class' => 'bajadev\ckeditor\actions\UploadAction',
                'url' => '@MediaUrl/temp/images/blog/posts/',
                'path' => '@media/temp/images/blog/posts/',
            ],
        ];

        return $actions;
    }

    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new Posts_s();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFilemanager() {

        return $this->render('filemanager');
    }

    public function actionTags($tag) {
        $helper = new \plathir\smartblog\helpers\PostHelper();
        $posts = $helper->getPostsbyTags($tag);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $posts,
            'sort' => [
                'attributes' => ['id'],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('tags', [
                    'dataProvider' => $dataProvider,
                    'posts' => $posts,
                    'tag' => $tag
        ]);
    }

//    public function actionTagslist() {
//        if (\Yii::$app->request->isAjax) {
//            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//            $items = Posts::find()->select(['tags'])->andHaving(['!=', 'tags', ''])->orderBy(['tags' => SORT_ASC])->all();
//            $resp_items = [];
//            $temp_items = [];
//            foreach ($items as $item) {
//                $newItems = explode(",", $item['tags']);
//                foreach ($newItems as $newItem) {
//                    $temp_items[] = $newItem;
//                }
//            }
//            //  make unique values
//            $temp_items = array_unique($temp_items);
//
//            foreach ($temp_items as $item) {
//                $resp_items[]["tags"] = $item;
//            }
//            return $resp_items;
//        } else {
//            
//        }
//    }

    public function actionTagslist() {
        if (\Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $items = Tags::find()->select(['name'])->orderBy(['name' => SORT_ASC])->all();
            foreach ($items as $item) {
                $resp_items[]["tags"] = $item["name"];
            }
            return $resp_items;
        } else {
            
        }
    }

    public function actionList() {
        $searchModel = new Posts_s();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Posts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $this->addViews($model);
        return $this->render('view', [
                    'model' => $model,
        ]);
    }

    private function addViews($model) {
        $model->views++;
        $model->save();
    }

    /**
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Posts();
        $model->user_created = \Yii::$app->user->getId();
        $model->user_last_change = \Yii::$app->user->getId();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //      $model->user_created = \Yii::$app->user->getId();
            //      $model->user_last_change = \Yii::$app->user->getId();
            $model->update();
            Yii::$app->getSession()->setFlash('success', Yii::t('blog', 'Post : {id} created ! ', ['id' => $model->id]));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (!isset($model->user_last_change)) {
                $model->user_last_change = \Yii::$app->user->getId();
            }

            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('blog', 'Post : {id} updated ! ', ['id' => $model->id]));
                return $this->redirect(['view', 'id' => $model->id]);
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

    public function actionUserposts($userid) {
        $posts = Posts::find()->where(['user_created' => $userid])->all();

        $PostModel = new Posts();
        $userModel = new $PostModel->module->userModel;
        $user = $userModel::findOne(['id' => $userid]);
        if ($user) {
            $username = $user->{$PostModel->module->userNameField};
            $dataProvider = new ArrayDataProvider([
                'allModels' => $posts,
                'sort' => [
                    'attributes' => ['id'],
                ],
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);

            return $this->render('userposts', [
                        'dataProvider' => $dataProvider,
                        'username' => $username
            ]);
        } else {
            throw new NotFoundHttpException(Yii::t('blog', 'The requested page does not exist.'));
        }
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        if ($this->findModel($id)->delete()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('blog', 'Post : {id} deleted ! ', ['id' => $model->id]));
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('blog', 'The requested page does not exist.'));
        }
    }

    public function actionCategory($categories) {
        $params = explode('/', $categories);
        print_r($params);
        die();
    }

}
