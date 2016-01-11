<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\SwitchInput;
use vova07\imperavi\Widget;
use kartik\widgets\DateTimePicker;
use vova07\fileapi\Widget as FileAPI;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'intro_text')->textarea(['rows' => 6]) ?>

    <?php
            echo $form->field($model, 'intro_image')->widget(FileAPI::className(), [
            'settings' => [
                'url' => ['posts/fileapi-upload'],
                'autoUpload' => true,
            ],
            'crop' => true,
        //    'cropResizeWidth' => 200,
        //    'cropResizeHeight' => 200
        ]);
        ?>
    
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

        <?php
            echo $form->field($model, 'full_image')->widget(FileAPI::className(), [
            'settings' => [
                'url' => ['posts/fileapi-upload'],
                'autoUpload' => true,
            ],
            'crop' => true,
        //    'cropResizeWidth' => 200,
        //    'cropResizeHeight' => 200
        ]);
        ?>

    <?= ''// $form->field($model, 'user_created')->textInput() ?>

    <div class="col-md-6 column">
        <?php
        echo $form->field($model, 'date_created')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Enter event time ...'],
            'readonly' => true,
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]);
        ?>
    </div>
    <div class="col-md-6 column">
        <?php
        echo $form->field($model, 'date_last_change')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Enter event time ...'],
            'readonly' => true,
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]);
        ?>
    </div>

    <?= ''// $form->field($model, 'user_last_change')->textInput()  ?>


    <?php echo $form->field($model, 'publish')->widget(SwitchInput::classname(), []); ?>

    <?= $form->field($model, 'categories')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
