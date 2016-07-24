<?php

use plathir\cropper\Widget as NewWidget;
use yii\helpers\Url;
use yii\widgets\Pjax;

$viewID = uniqid();
?>
<div id="<?= $viewID ?>">
    <?= $form->field($model, 'description')->textInput($inputOpts) ?>
    <?= ''
//    $form->field($model, 'image')->widget(NewWidget::className(), [
//        'uploadUrl' => Url::toRoute(['/blog/category/uploadphoto']),
//        'previewUrl' => $model->module->CategoryImagePathPreview,
//        'tempPreviewUrl' => $model->module->CategoryImageTempPathPreview,
//        'KeyFolder' => $model->id,
//        'width' => 200,
//        'height' => 200,
//    ]);
    ?>
</div>
