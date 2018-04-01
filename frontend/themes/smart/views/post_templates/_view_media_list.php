<?php

use yii\helpers\Html;

$imageURL = $model->module->ImagePathPreview . '/' . $model->id . '/' . $model->post_image;
?>

<div class="container">
    <div class="row">
        <!-- Left-aligned -->
        <div class="media">
            <div class="media-left">
                <?= Html::a('<img class="media-object image-in-list" src="' . $model->ImageUrlThumb . '" alt="...">', ['/blog/posts/view', 'id' => $model->id]) ?>
            </div>
            <div class="media-body">
                <h4 class="media-heading"><?= Html::a($model->description, ['/blog/posts/view', 'id' => $model->id]) ?><br><small><?= Yii::$app->formatter->asDatetime($model->created_at) ?></small></h4>
                <p><?php
                    $intro_text = (strlen($model->intro_text) > 100) ? mb_substr($model->intro_text, 0, 99) . '...' : $model->intro_text;
                    echo $intro_text;
                    ?>
                </p>
            </div>
        </div>
        <br>
    </div>
</div>
