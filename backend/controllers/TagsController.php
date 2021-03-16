<?php

namespace plathir\smartblog\backend\controllers;

use yii\web\Controller;
use plathir\smartblog\common\models\Tags;
use plathir\smartblog\common\models\PostsTags;
use yii\data\ArrayDataProvider;
use Yii;

/**
 * PostsController implements the CRUD actions for Posts model.
 */

/**
 * @property \plathir\smartblog\backend\Module $module
 *
 */
class TagsController extends Controller {

    public function __construct($id, $module) {
        parent::__construct($id, $module);
        $this->layout = "main";
    }

    
    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex() {
        $TagsList = Tags::find()->orderBy('name')->all();

        $dataProvider = new ArrayDataProvider([
            'allModels' => $TagsList,
            'sort' => [
                'defaultOrder' => [
                    'postcnt' => SORT_DESC
                ],
                'attributes' => ['postcnt', 'id', 'name',],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

//        print_r($TagsList);
        return $this->render('index', [
                    'TagsList' => $TagsList,
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionTagsrebuild() {
        if (\yii::$app->user->can('BlogRebuildTags')) {
            $posts_tags = PostsTags::find()->select(['tag_id'])->groupBy('tag_id')->orderBy(['tag_id' => SORT_ASC])->all();
            $db_tags = Tags::find()->select(['id'])->groupBy('id')->orderBy(['id' => SORT_ASC])->all();
            $stored_tags = [];
            foreach ($posts_tags as $tag) {
                $activeTags[] = $tag['tag_id'];
            }
            foreach ($db_tags as $s_tag) {
                $stored_tags[] = $s_tag['id'];
            }

            if ($stored_tags) {
                foreach ($stored_tags as $db_tag) {
                    if (array_search($db_tag, $activeTags, true) === false) {
                        if (Tags::findOne($db_tag)->delete()) {
                            echo Yii::t('blog', 'Tag {tag} deleted ! <br> ', ['tag' => $db_tag]);
                        }
                    }
                }
            }
            Yii::$app->getSession()->setFlash('success', Yii::t('blog', 'Rebuild tags succesfully !'));

            return $this->redirect('index');
        } else {
            throw new \yii\web\NotAcceptableHttpException(Yii::t('blog', 'No Permission to rebuild tags'));
        }
    }

}
