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
            'attribute' => 'description',
            'value' => function( $model ) {
                return Html::a($model->description, ['view', 'id' => $model->id ], []);
            },
                    'format' => 'html',
                ]
            ]
        ]);
        