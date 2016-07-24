<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Posts_s */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading"><?= Html::encode($this->title) ?></div>
    <div class="panel-body">
        <div class="posts-tags">

            <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    [
                        'label' => 'Descriprion',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return Html::a($data->description, ['/blog/posts/view', 'id' => $data->id]);
                        },
                            ],
                            //'description',
                            [
                                'attribute' => 'user_created',
                                'value' => function($model, $key, $index, $widget) {
                                    $userModel = new $model->module->userModel();
                                    return $userModel::findOne(['id' => $model->user_created])->{$model->module->userNameField};
                                },
                                        'format' => 'html',
                                        'contentOptions' => ['style' => 'width: 10%;']
                                    ],
                                    [
                                        'attribute' => 'created_at',
                                        'format' => ['date', 'php:d-m-Y'],
                                    ],
                                    [
                                        'attribute' => 'user_last_change',
                                        'value' => function($model, $key, $index, $widget) {
                                            $userModel = new $model->module->userModel();
                                            return $userModel::findOne(['id' => $model->user_last_change])->{$model->module->userNameField};
                                        },
                                                'format' => 'html'],
                                            [
                                                'attribute' => 'updated_at',
                                                'format' => ['date', 'php:d-m-Y'],
                                            ],
                                            [
                                                'attribute' => 'publish',
                                                'value' => function($model, $key, $index, $widget) {
                                                    return $model->publish == true ? '<span class="label label-success">Published</span>' : '<span class="label label-danger">Unpublished</span>';
                                                },
                                                'format' => 'html',
                                                'contentOptions' => ['style' => 'width: 10%;']
                                            ],
                                            [
                                                'attribute' => 'category',
                                                'contentOptions' => ['style' => 'width: 10%;']
                                            ],
                                        ],
                                    ]);
                                    ?>

        </div>
    </div>
</div>
