<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Posts_s */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    foreach ($dataProvider->getModels() as $pdata) {
        ?>
        <div class ="well">
            <?php
            echo Html::a('<h1>' . $pdata['description'] . '</h1>', ['view', 'id' => $pdata['id']]);
            echo "<img src=" . $pdata['intro_image'] . ">";
            echo $pdata['intro_text'] . '<br>';
            echo Html::a('More', ['view', 'id' => $pdata['id']], ['class' => 'btn btn-primary']);
            ?>
        </div>
        <?php
    }
    ?>


    <?php
    //echo
//    GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            'id',
//            'description',
//            'intro_text:ntext',
//            'full_text:ntext',
//            'intro_image',
//            // 'full_image',
//            // 'user_created',
//            // 'date_created',
//            // 'user_last_change',
//            // 'date_last_change',
//            // 'publish',
//            // 'categories',
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]);
    ?>

</div>
