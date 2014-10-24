<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Posts_s */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'intro_text') ?>

    <?= $form->field($model, 'full_text') ?>

    <?= $form->field($model, 'intro_image') ?>

    <?php // echo $form->field($model, 'full_image') ?>

    <?php // echo $form->field($model, 'user_created') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'user_last_change') ?>

    <?php // echo $form->field($model, 'date_last_change') ?>

    <?php // echo $form->field($model, 'publish') ?>

    <?php // echo $form->field($model, 'categories')  ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
