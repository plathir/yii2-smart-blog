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

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('blog', 'Translate Post : ' ) . $model->description ?>
    </div>

    <div class="panel-body">  

        <?php // print_r($modelLang); ?>

        <?php $form = ActiveForm::begin(); ?>
        <?php
        $hlp = new PostHelper();
        
        echo '<blockquote class = "blockquote-lightblue" ><h4>';
        echo Yii::t('blog', 'Translate to {lang}', ['lang' => strtoupper($modelLang->lang)]) . '&nbsp' . $hlp->getFlagByLang($modelLang->lang) . '<br><br>';
        echo '</h4></blockquote>';
        
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