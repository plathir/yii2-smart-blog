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
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'name' => 'UpdStaticPages']]); ?>
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9">
                <?= $form->field($modelLang, 'description')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($modelLang, 'intro_text')->textarea(['rows' => 6]) ?>        
                <?php echo $form->field($model, 'code_editor')->widget(SwitchInput::classname(), []); ?>
                <?php
                if ($model->code_editor) {
                    echo $form->field($model, 'css')->widget(AceEditorWidget::className(), [
                        'theme' => 'idle_fingers',
                        'mode' => 'css',
                        'showPrintMargin' => false,
                        'fontSize' => 14,
                        'height' => 300,
                        'options' => [
                            'style' => 'border: 1px solid #ccc; border-radius: 4px;'
                        ]
                    ]);
                    echo $form->field($modelLang, 'full_text')->widget(AceEditorWidget::className(), [
                        'theme' => 'idle_fingers',
                        'mode' => 'html',
                        'showPrintMargin' => false,
                        'fontSize' => 14,
                        'height' => 500,
                        'options' => [
                            'style' => 'border: 1px solid #ccc; border-radius: 4px;'
                        ]
                    ]);
                } else {
                    echo $form->field($modelLang, 'full_text')->widget(CKEditor::className(), [
                        'editorOptions' => ElFinder::ckeditorOptions('blog/elfinder', [/* Some CKEditor Options */
                            'entities_greek' => false
                        ]),
                    ]);
                }
                ?>

            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="panel panel-info">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><?= Yii::t('blog', 'Static Page Infos') ?></div>
                    <div class="panel-body">
                        <?php echo $form->field($model, 'publish')->widget(SwitchInput::classname(), []); ?>

                        <?php
                        echo $form->field($model, 'created_at')->widget(DateControl::classname(), [
                            'type' => DateControl::FORMAT_DATETIME,
                            'ajaxConversion' => true,
                            'saveFormat' => 'php:U',
                            'options' => [
                                'layout' => '{picker}{input}',
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'todayBtn' => true,
                                ]
                            ]
                        ]);
                        ?>
                        <?php
                        $userModel = new $model->module->userModel();
                        $items = \yii\helpers\ArrayHelper::map($userModel::find()->where('status = 10')->all(), 'id', $model->module->userNameField);
                        echo $form->field($model, 'user_created')->dropDownList($items)
                        ?>

                        <?php
                        echo $form->field($model, 'updated_at')->widget(DateControl::classname(), [
                            'type' => DateControl::FORMAT_DATETIME,
                            'ajaxConversion' => true,
                            'saveFormat' => 'php:U',
                            'options' => [
                                // 'pickerButton' => false,
                                'layout' => '{picker}{input}',
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'todayBtn' => true,
                                //    'pickerButton' => false,
                                ]
                            ]
                        ]);
                        ?>
                        <?php
                        $items1 = \yii\helpers\ArrayHelper::map($userModel::find()->where('status = 10')->all(), 'id', $model->module->userNameField);
                        echo $form->field($model, 'user_last_change')->dropDownList($items1)
                        ?>

                    </div>
                </div>
            </div>

        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> ' . Yii::t('blog', 'Save') : '<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> ' . Yii::t('blog', 'Save Changes'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>        

    </div>

</div>