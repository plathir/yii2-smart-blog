<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\datecontrol\DateControl;
use kartik\tree\TreeViewInput;
use plathir\smartblog\backend\models\Categorytree as Category;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Posts_s */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('blog', 'Static Pages');
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

            <p>
                <?= Html::a('<i class="fa fa-fw fa-plus"></i> ' . Yii::t('blog', 'Create Static Page'), ['create'], ['class' => 'btn btn-success']) ?>
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
                        'attribute' => 'id',
                        'contentOptions' => ['style' => 'width: 7%;']
                    ],
                    [
                        'attribute' => 'description',
                       'contentOptions' => ['style' => 'width: 20%;']
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
                        'format' => ['date', 'php:d-m-Y'],
                        'filter' =>
                        DateControl::widget([
                            'model' => $searchModel,
                            'attribute' => 'created_at',
                            'name' => 'kartik-date-1',
                            'value' => 'created_at',
                            'type' => DateControl::FORMAT_DATE,
                            'options' => [
                                'layout' => '{picker}{input}',
                            ]
                        ]),
                //        'contentOptions' => ['style' => 'width: 12%;']
                    ],
                    [
                        'attribute' => 'user_last_change',
                        'value' => function($model, $key, $index, $widget) {
                            $userModel = new $model->module->userModel();
                            return $userModel::findOne(['id' => $model->user_last_change])->{$model->module->userNameField};
                        },
                        'format' => 'html',
                        'filter' => \yii\bootstrap\Html::activeDropDownList($searchModel, 'user_last_change', $user_items, ['class' => 'form-control', 'prompt' => 'Select...']),
                 //       'contentOptions' => ['style' => 'width: 10%;']
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => ['date', 'php:d-m-Y'],
                        'filter' =>
                        DateControl::widget([
                            'model' => $searchModel,
                            'attribute' => 'updated_at',
                            'name' => 'kartik-date-2',
                            'value' => 'updated_at',
                            'type' => DateControl::FORMAT_DATE,
                            'options' => [
                                'layout' => '{picker}{input}',
                            ]
                        ]),
              //          'contentOptions' => ['style' => 'width: 10%;']
                    ],
                    [
                        'attribute' => 'publish',
                        'value' => function($model, $key, $index, $widget) {
                            return $model->publish == true ? '<span class="label label-success">' . Yii::t('blog', 'Published') . '</span>' : '<span class="label label-danger">' . Yii::t('blog', 'Unpublished') . '</span>';
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
