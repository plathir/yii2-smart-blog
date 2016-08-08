<?php

use plathir\cropper\Widget as NewWidget;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\Html;

$viewID = uniqid();
?>
<div id="<?= $viewID ?>">
    <?= $form->field($model, 'description')->textInput($inputOpts) ?>
    <?php
    if ($model->image) {
        echo Html::img($model->module->CategoryImagePathPreview . '/' . $model->id . '/' . $model->image, ['alt' => '...',
            // 'class' => 'img-circle',
            'width' => '100',
            'align' => 'center']);
    }
//    $form->field($model, 'image')->widget(NewWidget::className(), [
//        'id'=> uniqid(),
//        'uploadUrl' => Url::toRoute(['/blog/categorytree/uploadphoto']),
//        'previewUrl' => $model->module->CategoryImagePathPreview,
//        'tempPreviewUrl' => $model->module->CategoryImageTempPathPreview,
//        'KeyFolder' => $model->id,
//        'width' => 200,
//        'height' => 200,
//    ]);
    ?>
</div>
