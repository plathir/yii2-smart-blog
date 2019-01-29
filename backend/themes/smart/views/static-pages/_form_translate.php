<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\datecontrol\DateControl;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use lav45\aceEditor\AceEditorWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>

    </div><!-- /.box-header -->
    <div class="box-body">
     
      <?php // print_r($modelLang); ?>

        <?php $form = ActiveForm::begin(); ?>
        <?php
                echo strtoupper($modelLang->lang ) . '<br>';
                echo $model-> Description .'<br>';
                echo $form->field($modelLang, 'description')->textInput(["maxlength" => true]);
                echo $form->field($modelLang, 'intro_text')->textInput(["maxlength" => true]);
                echo $form->field($modelLang, 'full_text')->textInput(["maxlength" => true]);

        ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']); ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>