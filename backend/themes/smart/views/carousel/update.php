<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model apps\recipes\backend\models\Carousel */

$this->title = Yii::t('blog', 'Update {modelClass}: ', [
    'modelClass' => 'Carousel',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Carousels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('blog', 'Update');
?>
<div class="carousel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
