<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\DateTimePicker;
use yii\helpers\Url;
use plathir\cropper\Widget as NewWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>


    
    <div class="row">
        <div class="col-md-4 column">
            <?=
            $form->field($model, 'intro_image')->widget(NewWidget::className(), [
                'uploadUrl' => Url::toRoute(['/blog/posts/uploadphoto']),
                'previewUrl' => $model->module->ImagePathPreview,
                'tempPreviewUrl' => $model->module->ImageTempPathPreview,
            ]);
            ?>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 column">
            <?= $form->field($model, 'intro_text')->textarea(['rows' => 6]) ?>        
        </div>
    </div>
        
    
    <div class="row">
        <div class="col-md-4 column">
            <?=
            $form->field($model, 'full_image')->widget(NewWidget::className(), [
                'uploadUrl' => Url::toRoute(['/blog/posts/uploadphoto']),
                'previewUrl' => $model->module->ImagePathPreview,
                'tempPreviewUrl' => $model->module->ImageTempPathPreview,
            ]);
            ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <?php
            echo
            $form->field($model, 'full_text')->widget(\vova07\imperavi\Widget::className(), [

                'settings' => [
                    //  'lang' => 'en',
                    'minHeight' => 200,
                    //    'pastePlainText' => true,
                    //  'pasteImages' => true,
                    'plugins' => [
                        'clips',
                        'fullscreen'
                    ],
//            'imageGetJson' => Url::to(['/blog/posts/get']),
//            'imageUpload' => Url::to(['/blog/posts/image-upload']),
//            'fileUpload' => Url::to(['/blog/posts/file-upload']),
//            'clipboardUploadUrl' => Url::to(['/blog/posts/clipupl'])
                ]
            ]);
            ?>
        </div>
    </div>


    <?php
//    echo $form->field($model, 'full_image')->widget(FileAPI1::className(), [
//        'id' => 'image2',
//        'settings' => [
//            'url' => Url::to(['/blog/posts/fileapi-upload1']),
//            'autoUpload' => false,
//            'uploadOnlyImage' => true
//        ],
//        'crop' => true,
//            //    'cropResizeWidth' => 200,
//            //    'cropResizeHeight' => 200
//    ]);
    ?>

    <?= ''// $form->field($model, 'user_created')->textInput() ?>

    <div class="col-md-6 column">
        <?php
        echo $form->field($model, 'created_at')->widget(DateTimePicker::classname(), [
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
        echo $form->field($model, 'updated_at')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Enter event time ...'],
            'readonly' => true,
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]);
        ?>
    </div>

    <?= ''// $form->field($model, 'user_last_change')->textInput()   ?>
    <?php
//    $extensions = explode(', ', 'jpeg, jpg, png, gif');
//    print_r($extensions);
    ?>

    <?php echo $form->field($model, 'publish')->widget(SwitchInput::classname(), []); ?>

    <?= $form->field($model, 'categories')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
