<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model apps\recipes\backend\models\Carousel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carousel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('blog', '<i fa fa-save /i> Save'), ['class' => 'btn btn-success btn-flat btn-loader']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
