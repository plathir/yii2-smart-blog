<?php

use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

echo '<h3>Similar Posts :</h3>';

$provider = new ArrayDataProvider([
    'allModels' => $posts,
    'sort' => [
        'attributes' => ['id', 'description', 'email'],
    ],
    'pagination' => [
        'pageSize' => 10,
    ],
        ]);

echo GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        'id',
        [
            'format' => 'raw',
            'value' => function($model ) {
                return Html::a(Html::img($model->ImageUrlThumb, ['alt' => '...',
                                    'width' => '100',
                                    'align' => 'center']), ['view', 'id' => $model->id], []);
            }
        ],
        [
            'attribute' => 'description',
            'value' => function( $model ) {
                return Html::a($model->description, ['view', 'id' => $model->id], []);
            },
            'format' => 'html',
        ]
    ]
]);
