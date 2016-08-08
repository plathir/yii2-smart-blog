<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use plathir\cropper\Widget as NewWidget;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-primary">
    <div class="panel-heading">Category Update</div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'name' => 'UpdPost']]); ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <?=
                        $form->field($model, 'image')->widget(NewWidget::className(), [
                            'uploadUrl' => Url::toRoute(['/blog/categorytree/uploadphoto']),
                            'previewUrl' => $model->module->CategoryImagePathPreview,
                            'tempPreviewUrl' => $model->module->CategoryImageTempPathPreview,
                            'KeyFolder' => $model->id,
                            'width' => 200,
                            'height' => 200,
                        ]);
                        ?>


                    </div>


                </div>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Create' : '<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>