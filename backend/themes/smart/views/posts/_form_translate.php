<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use plathir\smartblog\backend\helpers\PostHelper;

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

        <?php // print_r($modelLang);  ?>

        <?php $form = ActiveForm::begin(); ?>
        <?php
        $hlp = new PostHelper();

        echo '<div class="callout callout-info"><h4>';
        echo Yii::t('blog', 'Translate to {lang}', ['lang' => strtoupper($modelLang->lang)]) . '&nbsp' . $hlp->getFlagByLang($modelLang->lang) . '<br><br>';
        echo '</h4></div>';

        // echo $model->Description . '<br>';
        echo $form->field($modelLang, 'description')->textInput(["maxlength" => true]);
        echo $form->field($modelLang, 'intro_text')->textarea(['rows' => 6]);
        echo $form->field($modelLang, 'full_text')->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('blog/elfinder', [/* Some CKEditor Options */
                //    'preset' => 'full',
                'entities_greek' => false,
                'embed_provider' => '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
                'extraPlugins' => 'image2,uploadimage,uploadfile,embed, colorbutton, justify, font',
            ]),
        ]);
        ?>


        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']); ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>