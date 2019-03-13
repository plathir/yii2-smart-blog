<?php
namespace plathir\smartblog\frontend\controllers;

use Yii;
use plathir\smartblog\frontend\models\Posts;
use plathir\smartblog\frontend\models\PostsLang;
use plathir\smartblog\frontend\models\search\Posts_s;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use plathir\smartblog\common\models\Tags;
use plathir\smartblog\frontend\helpers\PostHelper;
use yii\data\ArrayDataProvider;
use \plathir\smartblog\frontend\models\Category;
use yii\helpers\Url;

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
        $this->layout = "main";
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'uploadphoto' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['list',
                            'view',
                            'index',
                            'userposts',
                            'tags',
                            'tagslist',
                            'category',
                            'categoryall',
                            'author'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'create',
                            'update',
                            'view',
                            'delete',
                            'uploadphoto',
                            'uploadfile',
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
        $posts = Posts::find()->all();
        $helper = new PostHelper();
        $posts = $helper->OwnUnpublishFilter($posts);
        return $this->render('index', [
                    'posts' => $posts,
        ]);
    }

    /**
     * Displays a single Posts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $path = "", $slug = "") {
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
        if (\yii::$app->user->can('BlogCreatePost')) {
            $model = new Posts();
            $model->user_created = \Yii::$app->user->getId();
            $model->user_last_change = \Yii::$app->user->getId();
            $modelLang = new PostsLang();

            if ($model->load(Yii::$app->request->post()) && $modelLang->load(Yii::$app->request->post())) {
                $model->descr = $modelLang->description;
                if ($model->save()) {
                    $modelLang->id = $model->id;
                    $modelLang->lang = Yii::$app->settings->getSettings('MasterContentLang');

                    if ($modelLang->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        return $this->render('create', [
                                    'model' => $model,
                                    'modelLang' => $modelLang
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

//            $model = new Posts();
//            $model->user_created = \Yii::$app->user->getId();
//            $model->user_last_change = \Yii::$app->user->getId();
//
//
//            if ($model->load(Yii::$app->request->post()) && $model->save()) {
//                $model->update();
//                return $this->redirect(['view', 'id' => $model->id]);
//            } else {
//                return $this->render('create', [
//                            'model' => $model,
//                ]);
//            }
        } else {
            throw new \yii\web\NotAcceptableHttpException('No Permission to create new post');
        }
    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $path = "", $slug = "") {
        $model = $this->findModel($id);
        $modelLang = $this->findModelLang($id);
        if ((\yii::$app->user->can('BlogUpdateOwnPost', ['post' => $model])) || (\yii::$app->user->can('BlogUpdatePost'))) {
            $post_url = urldecode(Url::to(['/blog/posts/view/', 'path' => $model->urlpath, 'id' => $model->id, 'slug' => $model->slug], true));
            $post_url_update = urldecode(Url::to(['/blog/posts/update/', 'path' => $model->urlpath, 'id' => $model->id, 'slug' => $model->slug], true));
            if ($model->load(Yii::$app->request->post()) && $modelLang->load(Yii::$app->request->post())) {
                if (!isset($model->user_last_change)) {
                    $model->user_last_change = \Yii::$app->user->getId();
                }
                $model->descr = $modelLang->description;

                if ($modelLang->save()) {
                    if ($model->save()) {
                        Yii::$app->getSession()->setFlash('success', Yii::t('blog', 'Post : {id} updated ! ', ['id' => $model->id]));
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
            } else {
                return $this->render('update', [
                            'model' => $model,
                            'modelLang' => $modelLang,
                ]);
            }
        } else {
            throw new \yii\web\NotAcceptableHttpException('No Permission to update post');
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
            Yii::error('The requested page does not exist.', 'blog'); // category is added            
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

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

    public function actionUserposts($userid, $username = '') {
        $posts = Posts::find()->where(['user_created' => $userid, 'publish' => 1])->all();

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
                        'username' => $username,
                        'userid' => $userid
            ]);
        } else {
            throw new NotFoundHttpException(Yii::t('blog', 'The requested page does not exist. - ' . $userid));
        }
    }

    public function actionTags($tag) {
        $helper = new PostHelper();
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

    public function actionCategory($id, $slug = '') {


        $category = Category::findOne($id);

        $helper = new PostHelper();
        $posts = $helper->getPostsbyCategory($id);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $posts,
            'sort' => [
                'attributes' => ['id'],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('category', [
                    'dataProvider' => $dataProvider,
                    'posts' => $posts,
                    'category' => $id,
                    'categ' => $category,
                    'disp_subcat' => false
        ]);
    }

    
    protected function findModelLang($id) {

        if (($model = PostsLang::findOne(['id' => $id, 'lang' => Yii::$app->settings->getSettings('MasterContentLang')])) !== null) {
            return $model;
        } else {
            $model = new PostsLang();
            $model->id = $id;
            $model->lang = Yii::$app->settings->getSettings('MasterContentLang');
            return $model;
        }
    }    
    
    public function actionCategoryall($id, $slug = '') {
        $category = Category::findOne($id);
        $helper = new PostHelper();
        $posts = [];

        $Categories = $helper->getCategoriesWithSubCategories('', $id);
        foreach ($Categories as $cat) {
            $h_posts = $helper->getPostsbyCategory($cat->id);
            if ($h_posts) {
                foreach ($h_posts as $w_post) {
                    $posts[] = $w_post;
                }
            }
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $posts,
            'sort' => [
                'attributes' => ['id'],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('category', [
                    'dataProvider' => $dataProvider,
                    'posts' => $posts,
                    'category' => $id,
                    'categ' => $category,
                    'disp_subcat' => true
        ]);
    }

}
