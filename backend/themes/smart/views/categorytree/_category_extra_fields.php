<?php

use yii\helpers\Html;

$viewID = uniqid();
?>
<div id="<?= $viewID ?>">
    <?= $form->field($node, 'description')->textInput() ?>
    <?php
    if ($node->image) {
        echo Html::img($node->module->CategoryImagePathPreview . '/' . $node->id . '/' . $node->image, ['alt' => '...',
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
