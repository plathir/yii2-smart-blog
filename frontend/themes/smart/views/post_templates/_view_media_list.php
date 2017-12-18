<?php

use yii\helpers\Html;

$imageURL = $model->module->ImagePathPreview . '/' . $model->id . '/' . $model->intro_image;
?>
<div class="media-left media-middle">
    <?= Html::a('<img class="media-object image-in-list" src="' . $imageURL . '" alt="...">', ['/blog/posts/view', 'id' => $model->id]) ?>
</div>

<div class="media-body">
    <h4 class="media-heading"><?= Html::a($model->description, ['/blog/posts/view', 'id' => $model->id]) ?></h4>

    <?php
    $model->intro_text = (strlen($model->intro_text) > 100) ? substr($model->intro_text, 0, 100) . '...' : $model->intro_text;
    // echo $model->intro_text;
    ?>

</div>
