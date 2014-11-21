<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'intro_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'full_text')->textarea(['rows' => 6]) ?>
    <?=
    yii\imperavi\Widget::widget([
        // You can either use it for model attribute
        'model' => $model,
        'attribute' => 'full_text',
        'options' => [
            'toolbar' => true,
            'css' => 'wym.css',
        ],
    ]);
    ?>

    <?= $form->field($model, 'intro_image')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'full_image')->textInput() ?>

    <?= $form->field($model, 'user_created')->textInput() ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'user_last_change')->textInput() ?>

    <?= $form->field($model, 'date_last_change')->textInput() ?>

    <?= $form->field($model, 'publish')->textInput() ?>

    <?= $form->field($model, 'categories')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
