<?php

use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

echo '<h3>Similar Posts :</h3>';

$provider = new ArrayDataProvider([
    'allModels' => $posts,
    'sort' => [
        'attributes' => [ 'id',  'imageUrl', 'description'],
    ],
    'pagination' => [
        'pageSize' => 10,
    ],
        ]);

echo GridView::widget([
    'dataProvider' => $provider,
    'tableOptions' => [
        'class' => 'table table-condensed',
    ],
    'columns' => [
        [
            'attribute' => 'imageUrl',
            'value' => function ( $model ) {
                return $model->imageUrl;
            },
            'format' => ['image', ['width' => '100', 'height' => 'auto']],
        ],
        //   'imageUrl:image',
        'id',
        [
            'attribute' => 'description',
            'value' => function( $model ) {
                return Html::a($model->description, ['view', 'id' => $model->id], []);
            },
            'format' => 'html',
        ]
    ]
]);
