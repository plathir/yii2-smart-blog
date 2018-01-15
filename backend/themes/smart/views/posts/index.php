<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\datecontrol\DateControl;
use kartik\tree\TreeViewInput;
use plathir\smartblog\backend\models\Categorytree as Category;
use \backend\widgets\SmartDate;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Posts_s */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>

    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="posts-index">

            <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

            <p>
                <?=
                Html::a(Html::tag('span', '<i class="fa fa-fw fa-plus"></i>' . '&nbsp' . Yii::t('blog', 'Create'), [
                            'title' => Yii::t('blog', 'Create New Post'),
                            'data-toggle' => 'tooltip',
                        ]), ['create'], ['class' => 'btn btn-success btn-flat btn-loader'])
                ?>                  
            </p>
            <?php
            $userModel = new $searchModel->module->userModel();
            $user_items = \yii\helpers\ArrayHelper::map($userModel::find()->where('status = 10')->all(), 'id', 'username');
            ?>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],
                    [
                        'header' => 'Image',
                        'format' => 'raw',
                        'value' => function($model, $key, $index, $grid) {
                            return Html::img($model->imageurl, ['alt' => '...',
//                                        'class' => 'img-thumbnail',
                                        'width' => '50',
                                        'align' => 'center']);
                        },
                        'filterOptions' => ['class' => 'hidden-xs hidden-sm hidden-md'],
                        'headerOptions' => ['class' => 'hidden-xs hidden-sm'],
                        'contentOptions' => ['data-columnname' => 'Image', 'class' => 'hidden-xs hidden-sm hidden-md'],
                    ],
                                
                    [
                        'attribute' => 'id',
                        'contentOptions' => ['style' => 'width: 7%;']
                    ],
                    [
                        'attribute' => 'description',
                        'value' => function ($model) {
                          return Html::a($model->description, ['/blog/posts/view', 'id' => $model->id]);  
                        },
                        'format' =>'raw',        
                        'contentOptions' => ['style' => 'width: 15%;']
                    ],
                    [
                        'attribute' => 'category',
                        'value' => function ($model) {
                            if ($model->category) {
                                $category = Category::findOne(['id' => $model->category]);
                                if ($category) {
                                    return $category->name;
                                }
                            }
                        },
                        'contentOptions' => ['style' => 'width: 15%;'],
                        'headerOptions' => ['class' => 'hidden-xs hidden-sm hidden-md'],                                
                        'filter' =>
                        TreeViewInput::widget([
                            // single query fetch to render the tree
                            // use the Product model you have in the previous step
                            'model' => $searchModel,
                            'attribute' => 'category',
                            'showInactive' => true,
                            'query' => Category::find()->addOrderBy('root, lft'),
                            'headingOptions' => ['label' => 'Categories',
                            ],
//                                            'name' => 'kv-product', // input name
//                                            'value' => '1,2,3', // values selected (comma separated for multiple select)
                            'asDropdown' => true, // will render the tree input widget as a dropdown.
                            'multiple' => true, // set to false if you do not need multiple selection
                            'fontAwesome' => true, // render font awesome icons
                            'dropdownConfig' => [
                                'dropdown' => [
                                    'style' => 'width:250px',
                                ],
                            ],
                            'rootOptions' => [
                                'label' => '<i class="fa fa-tree"></i>', // custom root label
                                'class' => 'text-success',
                            ],
                                //'options'=>['disabled' => true],
                        ])
                    ],
                    [
                        'attribute' => 'user_created',
                        'value' => function($model, $key, $index, $widget) {
                            $userModel = new $model->module->userModel();
                            return $userModel::findOne(['id' => $model->user_created])->{$model->module->userNameField};
                        },
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width: 10%;'],
                        'filter' => \yii\bootstrap\Html::activeDropDownList($searchModel, 'user_created', $user_items, ['class' => 'form-control', 'prompt' => 'Select...'])
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:' . Yii::$app->settings->getSettings('ShortDateFormat')],
                        'value' => 'created_at',
                        'filter' => SmartDate::widget(['type' => 'filterShortDate', 'model' => $searchModel, 'attribute' => 'created_at']),
                        'contentOptions' => ['style' => 'width: 12%;']
                    ],

                    [
                        'attribute' => 'user_last_change',
                        'value' => function($model, $key, $index, $widget) {
                            $userModel = new $model->module->userModel();
                            return $userModel::findOne(['id' => $model->user_last_change])->{$model->module->userNameField};
                        },
                        'format' => 'html',
                        'filter' => \yii\bootstrap\Html::activeDropDownList($searchModel, 'user_last_change', $user_items, ['class' => 'form-control', 'prompt' => 'Select...']),
                        'contentOptions' => ['style' => 'width: 10%;']
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => ['date', 'php:' . Yii::$app->settings->getSettings('ShortDateFormat')],
                        'value' => 'updated_at',
                        'filter' => SmartDate::widget(['type' => 'filterShortDate', 'model' => $searchModel, 'attribute' => 'updated_at']),
                        'filterOptions' => ['class' => 'hidden-xs hidden-sm hidden-md'],
                        'headerOptions' => ['class' => 'hidden-xs hidden-sm hidden-md'],
                        'contentOptions' => ['data-columnname' => 'Upadted_at', 'style' => 'width: 12%;', 'class' => 'hidden-xs hidden-sm hidden-md'],
                    ],                                
                                
                    [
                        'attribute' => 'publish',
                        'value' => function($model, $key, $index, $widget) {
                            return $model->publish == true ? '<span class="label label-success">Published</span>' : '<span class="label label-danger">Unpublished</span>';
                        },
                        'format' => 'html',
                        'filter' => \yii\bootstrap\Html::activeDropDownList($searchModel, 'publish', ['0' => 'Unpublished', '1' => 'Published'], ['class' => 'form-control', 'prompt' => 'Select...']),
                        'contentOptions' => ['style' => 'width: 10%;']
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['style' => 'min-width: 70px;']
                    ],
                ],
            ]);
            ?>

        </div>
    </div>
</div>
