<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;
use plathir\cropper\Widget as NewWidget;
use plathir\upload\Widget as UplWidget;
use dosamigos\selectize\SelectizeTextInput;
use kartik\tree\TreeViewInput;
use plathir\smartblog\backend\models\Categorytree as Category;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

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
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'name' => 'UpdPost']]); ?>
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9">
                <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <?=
                        $form->field($model, 'post_image')->widget(NewWidget::className(), [
                            'uploadUrl' => Url::toRoute(['/blog/posts/uploadphoto']),
                            'previewUrl' => $model->module->ImagePathPreview,
                            'tempPreviewUrl' => $model->module->ImageTempPathPreview,
                            'KeyFolder' => $model->id,
                            'width' => $model->module->image_width,
                            'height' => $model->module->image_height,
                            'cropAreaWidth' => $model->module->crop_image_width,
                            'cropAreaHeight' => $model->module->crop_image_height,
                        ]);
                        ?>

                    </div>


                </div>

                <?= $form->field($model, 'intro_text')->textarea(['rows' => 6]) ?>        

                <?php
//                echo $form->field($model, 'full_text')->widget(CKEditor::className(), [
//                    'editorOptions' => ElFinder::ckeditorOptions('blog/elfinder', [/* Some CKEditor Options */
//                    ]),
//                ]);
                ?>
                <?php
                //   echo 'test'. $model->module->editor;
                switch ($model->module->editor) {
                    case 'CKEditor':
                        echo $form->field($model, 'full_text')->widget(CKEditor::className(), [
                            'editorOptions' => ElFinder::ckeditorOptions('blog/elfinder', [/* Some CKEditor Options */
                                'entities_greek' => false
                            ]),
                        ]);

                        break;
                    case 'markdown':
                        echo $form->field($model, 'full_text')->widget(\yii2mod\markdown\MarkdownEditor::class, [
                            'editorOptions' => [
                                'showIcons' => ["code", "table"],
                                'renderingConfig' => [
                                    'codeSyntaxHighlighting' => true,
                                ]
                            ],
                        ]);
                        break;
                    default:
                        break;
                }
                ?>

                <?php
//                echo
//                $form->field($model, 'full_text')->widget(\vova07\imperavi\Widget::className(), [
//
//                    'settings' => [
//                        //  'lang' => 'en',
//                        'minHeight' => 200,
//                        //    'pastePlainText' => true,
//                        //  'pasteImages' => true,
//                        'plugins' => [
//                            'clips',
//                            'fullscreen'
//                        ],
////            'imageGetJson' => Url::to(['/blog/posts/get']),
////            'imageUpload' => Url::to(['/blog/posts/image-upload']),
////            'fileUpload' => Url::to(['/blog/posts/file-upload']),
////            'clipboardUploadUrl' => Url::to(['/blog/posts/clipupl'])
//                    ]
//                ]);
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
                <div class="row-fluid">
                    <?php
                    echo $form->field($model, 'attachments')->widget(UplWidget::className(), [
                        'uploadUrl' => Url::toRoute(['/blog/posts/uploadfile']),
                        'previewUrl' => $model->module->ImagePathPreview,
                        'tempPreviewUrl' => $model->module->ImageTempPathPreview,
                        'KeyFolder' => $model->id,
                    ]);
                    ?>
                </div>
                <div class="row-fluid">
                    <?php
                    echo $form->field($model, 'gallery')->widget(UplWidget::className(), [
                        'uploadUrl' => Url::toRoute(['/blog/posts/uploadfile']),
                        'previewUrl' => $model->module->ImagePathPreview,
                        'tempPreviewUrl' => $model->module->ImageTempPathPreview,
                        'KeyFolder' => $model->id,
                        'galleryType' => true,
                    ]);
                    ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="panel panel-info">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Post Infos</div>
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
            <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Create' : '<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>        

    </div>

</div>