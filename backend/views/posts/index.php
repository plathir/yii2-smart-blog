<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Posts_s */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <p>
        <?= Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'description',
            [
                'attribute' => 'user_created',
                'value' => function($model, $key, $index, $widget) {
                    $userModel = new $model->module->userModel();
                    return $userModel::findOne(['id' => $model->user_created])->{$model->module->userNameField};
                },
                        'format' => 'html'
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
                        ])
                    ],
                    [
                        'attribute' => 'user_last_change',
                        'value' => function($model, $key, $index, $widget) {
                            $userModel = new $model->module->userModel();
                            return $userModel::findOne(['id' => $model->user_last_change])->{$model->module->userNameField};
                        },
                                'format' => 'html',
                                'filter' => function($model ) {
                            $user_items = \yii\helpers\ArrayHelper::map(plathir\user\models\account\User::find()->where('status = 10')->all(), 'id', 'username');
                            return \yii\bootstrap\Html::dropDownList($user_items);
                        }
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
                                ])
                            ],
                            [
                                'attribute' => 'publish',
                                'value' => function($model, $key, $index, $widget) {
                                    return $model->publish == true ? '<span class="label label-success">Published</span>' : '<span class="label label-danger">Unpublished</span>';
                                },
                                'format' => 'html'
                            ],
                            // 'categories',
                            ['class' => 'yii\grid\ActionColumn',
                                'contentOptions' => ['style' => 'min-width: 70px;']
                            ],
                        ],
                    ]);
                    ?>

</div>
