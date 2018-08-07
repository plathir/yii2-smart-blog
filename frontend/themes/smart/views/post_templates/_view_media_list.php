<?php

use yii\helpers\Html;
use yii\helpers\Url;

$imageURL = $model->module->ImagePathPreview . '/' . $model->id . '/' . $model->post_image;
$post_url = urldecode(Url::to(['/blog/posts/view/', 'path' => $model->urlpath, 'id' => $model->id, 'slug' => $model->slug], true));
?>

<div class="container">
    <div class="row">
        <!-- Left-aligned -->
        <div class="media">
            <div class="media-left">
                <?= Html::a('<img class="media-object image-in-list" src="' . $model->ImageUrlThumb . '" alt="...">', $post_url) ?>
            </div>
            <div class="media-body">
                <?php $descr = (strlen($model->description) > 100) ? mb_substr($model->description, 0, 99) . '...' : $model->description; ?>

                <h4 class="media-heading"><?= Html::a($descr, $post_url ) ?><br><small><?= Yii::$app->formatter->asDatetime($model->created_at) ?></small></h4>
                <p><?php
                    $intro_text = (strlen($model->intro_text) > 100) ? mb_substr($model->intro_text, 0, 99) . '...' : $model->intro_text;
                    ?>
                </p>
            </div>
        </div>
        <br>
    </div>
</div>
