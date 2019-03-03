<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use plathir\upload\ListFilesWidget;
use yii\bootstrap\Tabs;
use plathir\smartblog\common\widgets\TagsWidget;
use \plathir\smartblog\backend\widgets\SimilarPostsWidget;
use \plathir\smartblog\common\widgets\GalleryWidget;
use kartik\widgets\StarRating;
use \plathir\smartblog\common\widgets\RatingWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><?= 'View Post :' . Html::encode($this->title) ?></h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>

    </div><!-- /.box-header -->
    <div class="box-body">

        <div class="posts-view">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?=
                Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </p>


            <?php
            $tr = '';
            $appLanguage = Yii::$app->settings->getSettings('MasterContentLang');
            foreach (Yii::$app->urlManager->languages as $language) {
                if ($language != $appLanguage) {
                    if ($language == 'el') {
                        $temp_lang = 'gr';
                    } else {
                        $temp_lang = $language;
                    }
                    $tr .= Html::a('<i class="fa fa-pencil-square-o"></i>&nbsp;' . 'Translate ' . '<img src="https://www.countryflags.io/' . $temp_lang . '/flat/16.png">', ['translate', 'id' => $model->id, 'lang' => $language], ['class' => 'list-group-item list-group-item-info']);
                }
            }
            ?>  


            <?php
            $tr_html = '';
            if ($tr) {
                $tr_html = '<div class="col-lg-3">' .
                        '<div class="panel panel-default">' .
                        '<div class="panel-heading">Translations</div>' .
                        '<div class="panel-body">' .
                        '<div class="list-group">' .
                        $tr .
                        '</div>' .
                        '</div>' .
                        '</div>' .
                        '</div>' .
                        '<div class="col-lg-9">' .
                        '</div>';
            }
            ?>

            <?php
            $userModel = new $model->module->userModel();
            $categoryModel = new plathir\smartblog\backend\models\Category();

            $detailView = $tr_html .
                    DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width:20%">{label}</th><td style="width:80%">{value}</td></tr>',
                        'attributes' => [
                            'id',
                            'description',
                            'slug',
                            'views',
                            'intro_text:ntext',
                            [
                                'attribute' => 'fulltext_html',
                                'value' => function( $model ) {
                                    return $model->fulltext_html;
                                },
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'post_image',
                                'value' => $model->post_image == '' ? '' : ( $model->module->ImagePathPreview . '/' . $model->id . '/' . $model->post_image),
                                'format' => $model->post_image == '' ? 'html' : ['image', ['width' => '100', 'height' => '100']],
                            ],
                            [
                                'attribute' => 'user_created',
                                'value' => $userModel::findOne(['id' => $model->user_created])->{$model->module->userNameField},
                                'format' => 'text'
                            ],
                            'created_at:datetime',
                            [
                                'attribute' => 'user_last_change',
                                'value' => $userModel::findOne(['id' => $model->user_last_change])->{$model->module->userNameField},
                                'format' => 'html'
                            ],
                            'updated_at:datetime',
                            [
                                'attribute' => 'publish',
                                'value' => $model->publish == true ? '<span class="label label-success">Published</span>' : '<span class="label label-danger">Unpublished</span>',
                                'format' => 'html'
                            ],
                            [
                                'attribute' => 'category',
                                'value' => $categoryModel::findOne(['id' => $model->category])->name,
                                'format' => 'text'
                            ],
                        ],
            ]);


            echo Tabs::widget([
                'items' => [
                    [
                        'label' => 'Post Contents',
                        'content' => $detailView
                        .
                        TagsWidget::widget([
                            'tags' => $model->tags,
                        ]) .
                        SimilarPostsWidget::widget([
                            'postID' => $model->id,
                        ]),
                        'active' => true
                    ],
                    [
                        'label' => 'Attachments',
                        'content' => ListFilesWidget::widget([
                            'model' => $model,
                            'previewUrl' => $model->module->ImagePathPreview,
                            'KeyFolder' => $model->id,
                            'attribute' => 'attachments',
                        ]),
                        //    'headerOptions' => [...],
                        'options' => ['id' => 'myveryownID'],
                    ],
//                    [
//                        'label' => 'Similar Posts',
//                        'content' => SimilarPostsWidget::widget([
//                            'postID' => $model->id,
//                        ]),
//                        //    'headerOptions' => [...],
//                        'options' => ['id' => 'myveryownID1'],
//                    ],
                    [
                        'label' => 'Gallery',
                        'content' => GalleryWidget::widget([
                            'galleryItems' => $model->gallery,
                            'imagePath' => $model->module->ImagePath . '/' . $model->id,
                            'previewUrl' => $model->module->ImagePathPreview . '/' . $model->id,
                        ]),
                        //    'headerOptions' => [...],
                        'options' => ['id' => 'myveryownID2'],
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>

