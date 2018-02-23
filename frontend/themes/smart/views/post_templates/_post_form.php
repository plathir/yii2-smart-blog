<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use kartik\tree\TreeViewInput;
use plathir\smartblog\backend\models\Categorytree as Category;
use plathir\cropper\Widget as NewWidget;
use yii\helpers\Url;
use dosamigos\selectize\SelectizeTextInput;
use plathir\upload\Widget as UplWidget;
use kartik\widgets\SwitchInput;
?>


<div class="panel panel-default">
    <div class="panel-heading">
        Create New Post
    </div>

    <div class="panel-body">  
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'name' => 'UpdPost']]); ?>        
        <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>
        <?=
        $form->field($model, 'post_image')->widget(NewWidget::className(), [
            'uploadUrl' => Url::toRoute(['/blog/posts/uploadphoto']),
            'previewUrl' => $model->module->ImagePathPreview,
            'tempPreviewUrl' => $model->module->ImageTempPathPreview,
            'KeyFolder' => $model->id,
            'width' => 200,
            'height' => 200,
        ]);
        ?>
        <?= $form->field($model, 'intro_text')->textarea(['rows' => 6]) ?>          
        <?=
        $form->field($model, 'full_text')->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('blog/elfinder', [/* Some CKEditor Options */
            ]),
        ]);
        ?>
        <?=
        $form->field($model, 'tags')->widget(SelectizeTextInput::className(), [
            'loadUrl' => ['/blog/posts/tagslist'],
            'options' => ['class' => 'form-control'],
            'clientOptions' => [
                'plugins' => ['remove_button'],
                'valueField' => 'tags',
                'labelField' => 'tags',
                'searchField' => ['tags'],
                'create' => true,
            ],
        ])
        ?>        
        <?=
        $form->field($model, 'category')->widget(TreeViewInput::className(), [
            'model' => $model,
            'attribute' => 'category',
            'query' => Category::find()->addOrderBy('root, lft'),
            'headingOptions' => ['label' => 'Categories'],
            //  'name' => 'categories', // input name
            //  'value'             => '1,2,3',         // values selected (comma separated for multiple select)
            'asDropdown' => true, // will render the tree input widget as a dropdown.
            'multiple' => false, // set to false if you do not need multiple selection
            'showInactive' => true,
            'fontAwesome' => true, // render font awesome icons
            'rootOptions' => [
                'label' => '<i class="fa fa-tree"></i>',
                'class' => 'text-success'
            ], // custom root label
                //'options'         => ['disabled' => true],
        ]);
        ?> 
        <?=
        $form->field($model, 'attachments')->widget(UplWidget::className(), [
            'uploadUrl' => Url::toRoute(['/blog/posts/uploadfile']),
            'previewUrl' => $model->module->ImagePathPreview,
            'tempPreviewUrl' => $model->module->ImageTempPathPreview,
            'KeyFolder' => $model->id,
        ]);
        ?>

        <?=
        $form->field($model, 'gallery')->widget(UplWidget::className(), [
            'uploadUrl' => Url::toRoute(['/blog/posts/uploadfile']),
            'previewUrl' => $model->module->ImagePathPreview,
            'tempPreviewUrl' => $model->module->ImageTempPathPreview,
            'KeyFolder' => $model->id,
            'galleryType' => true,
        ]);
        ?>        
        <?php echo $form->field($model, 'publish')->widget(SwitchInput::classname(), []); ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Create' : '<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>            
    </div>
</div>


