<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Posts_s */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-tags">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
   
    foreach($posts as $post) {
        echo $post->id;
    }
             

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
            
            'user_created',
            'created_at:date',
            'user_last_change',
            'updated_at:date',
             'publish',
            // 'categories',
        ],
    ]);
    ?>

</div>
