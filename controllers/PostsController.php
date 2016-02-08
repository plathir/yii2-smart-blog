<?php

namespace plathir\smartblog\controllers;

use Yii;
use plathir\smartblog\models\Posts;
use plathir\smartblog\models\search\Posts_s;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * PostsController implements the CRUD actions for Posts model.
 */

/**
 * @property \plathir\smartblog\Module $module
 * 
 */
class PostsController extends Controller {

    public function __construct($id, $module) {
        parent::__construct($id, $module);
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'clipupl' => ['post'],
                    'uploadphoto' => ['post']
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
                            'uploadphoto'
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
            'uploadphoto' => [
                'class' => '\plathir\cropper\actions\UploadAction',
                'width' => 600,
                'height' => 600,
                'temp_path' => $this->module->ImageTempPath,
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
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
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
            $model->user_created = \Yii::$app->user->getId();
            $model->user_last_change = \Yii::$app->user->getId();
            if (isset($model->attachmentFiles)) {
                $model->attachmentFiles = UploadedFile::getInstances($model, 'attachmentFiles');
                $model->attachments = $this->uploadToTemp($model);
                $this->moveToFolder($model);
                $model->update();
            } else {
                $model->update();
            }

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
        $model->user_last_change = \Yii::$app->user->getId();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->user_last_change = \Yii::$app->user->getId();
            if (isset($model->attachmentFiles)) {
                $model->attachmentFiles = UploadedFile::getInstances($model, 'attachmentFiles');
                $model->attachments = $this->uploadToTemp($model);
                $this->moveToFolder($model);
                $model->update();
            } else {
                $model->update();
            }


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

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
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionClipupl() {

        $dir = $this->module->ImagePath;
        $url = $this->module->ImagePathPreview;

        $contentType = $_POST['contentType'];
        $data = base64_decode($_POST['data']);

        $filename = md5(date('YmdHis')) . '.png';
        $file = $dir . DIRECTORY_SEPARATOR . $filename;

        file_put_contents($file, $data);

        return json_encode(array('filelink' => $url . $filename));
    }

    /**
     * 
     * @param type $model
     * @return boolean
     */
    public function uploadToTemp($model) {
        $FilesArray = '';
        if ($model->validate()) {
            foreach ($model->attachmentFiles as $file) {
                $this->movetoTempFolder($file);
                $FilesArray[] = $file->baseName . '.' . $file->extension;
            }
            if ($FilesArray) {
                return implode(",", $FilesArray);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $model
     * @return boolean
     */
    public function moveToFolder($model) {
        $FilesArray = '';
        if ($model->validate()) {
            foreach ($model->attachmentFiles as $file) {
                $this->movefiletoFolder($file->name, $model->id);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $file
     */
    public function movetoTempFolder($file) {
        $file->saveAs(Yii::getAlias($this->module->ImageTempPath) . DIRECTORY_SEPARATOR . $file->baseName . '.' . $file->extension);
    }

    /**
     * 
     * @param type $file
     * @param type $KeyFolder
     * @return boolean
     */
    public function movefiletoFolder($file, $KeyFolder) {
        $tempFile = FileHelper::normalizePath(Yii::getAlias($this->module->ImageTempPath) . DIRECTORY_SEPARATOR . $file);

        if ($KeyFolder) {
            $newPath = FileHelper::normalizePath(Yii::getAlias($this->module->ImagePath) . DIRECTORY_SEPARATOR . $KeyFolder);
            $newFile = FileHelper::normalizePath($newPath . DIRECTORY_SEPARATOR . $file);
        } else {
            $newPath = FileHelper::normalizePath(Yii::getAlias($this->module->ImagePath));
            $newFile = FileHelper::normalizePath($newPath . DIRECTORY_SEPARATOR . $file);
        }
        if (is_file($tempFile) && FileHelper::createDirectory($newPath)) {
            if (rename($tempFile, $newFile)) {
                return true;
            }
        }
    }

    public function deleteOldFiles() {
        
    }
    
    
    
}
