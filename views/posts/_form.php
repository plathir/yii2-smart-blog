<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\SwitchInput;
use kartik\widgets\FileInput;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'intro_text')->textarea(['rows' => 6]) ?>

    <?php //= //$form->field($model, 'full_text')->textarea(['rows' => 6])  ?>

    <?php



echo $form->field($model, 'full_text')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'en',
            'minHeight' => 200,
            'pastePlainText' => true,
            'plugins' => [
                'clips',
                'fullscreen'
            ]
        ]
    ]);
    ?>

    <?= ''// $form->field($model, 'intro_image')->textInput(['maxlength' => 255]) ?>
    <?php
    echo $form->field($model, 'intro_image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]);
    ?>
    
    <?= ''// $form->field($model, 'full_image')->textInput() ?>

    <?php
    echo $form->field($model, 'full_image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]);
    ?>
    
    <?= $form->field($model, 'user_created')->textInput() ?>

    <?= ''// $form->field($model, 'date_created')->textInput() ?>
    <?php
    echo $form->field($model, 'date_created')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter Created date ...'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]);
    ?>
    <?= $form->field($model, 'user_last_change')->textInput() ?>

    <?= ''// $form->field($model, 'date_last_change')->textInput()  ?>

    <?php
    echo $form->field($model, 'date_last_change')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter Last change date ...'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]);
    ?>

    <?=  $form->field($model, 'publish')->textInput() ?>
    <?php echo $form->field($model, 'publish')->widget(SwitchInput::classname(), []); ?>

<?= $form->field($model, 'categories')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
