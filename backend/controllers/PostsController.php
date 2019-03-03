<?php

namespace plathir\smartblog\backend\controllers;

use Yii;
use plathir\smartblog\backend\models\Posts;
use plathir\smartblog\backend\models\PostsLang;
use plathir\smartblog\backend\models\search\Posts_s;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use plathir\smartblog\common\models\Tags;
use yii\helpers\Html;

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
                            'translate',
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
                'width' => $this->module->store_image_width,
                'height' => $this->module->store_image_height,
                'thumbnail' => true,
                'thumbnail_width' => $this->module->store_thumbnail_width,
                'thumbnail_height' => $this->module->store_thumbnail_height,
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
        $helper = new \plathir\smartblog\backend\helpers\PostHelper();
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
        $modelLang = new StaticPagesLang();

       if ($model->load(Yii::$app->request->post()) && $modelLang->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $model->descr = $modelLang->description;
                // $model->full_text = \yii\helpers\HtmlPurifier::process($model->full_text);
                if ($model->update()) {
                    $modelLang->id = $model->id;
                    $modelLang->lang = Yii::$app->settings->getSettings('MasterContentLang');
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
     * Updates an existing Posts model.
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
            $model->intro_text = $modelLang->intro_text;
            $model->full_text = $modelLang->full_text;

            if ($model->save()) {
                $modelLang->save();
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
            Yii::$app->getSession()->setFlash('success', Yii::t('blog', 'Post : {id} deleted ! ', ['id' => $id]));
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
//        print_r($params);
//        die();
    }

    protected function findModelLang($id) {

        if (($model = PostsLang::findOne(['id' => $id, 'lang' => Yii::$app->settings->getSettings('MasterContentLang')])) !== null) {
            echo 'In';
            die();
            return $model;
        } else {
            $model = new PostsLang();
            $model->id = $id;
            $model->lang = Yii::$app->settings->getSettings('MasterContentLang');
            return $model;
        }
    }

    public function actionTranslate($id, $lang) {
        $model = $this->findModel($id);
        $modelLang = PostsLang::find()->where(['id' => $id, 'lang' => $lang])->One();

        if (!$modelLang) {
            $masterLang = Yii::$app->settings->getSettings('MasterContentLang');
            $modelLang = new PostsLang();
            $modelLang->id = $id;
            $modelLang->lang = $lang;
            $modelLang->description = Yii::$app->translate->translate($masterLang, $lang, $model->description)['text'][0];
            $modelLang->intro_text = Yii::$app->translate->translate($masterLang, $lang, $model->intro_text, 'plain')['text'][0];
            $modelLang->full_text = html::decode(Yii::$app->translate->translate($masterLang, $lang, $model->full_text)['text'][0]);
        }
        if ($modelLang->load(Yii::$app->request->post()) && $modelLang->save()) {
            Yii::$app->session->setFlash('success', "Save translation successfully.");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('translation', [
                        'model' => $model,
                        'modelLang' => $modelLang,
            ]);
        }
    }

}
