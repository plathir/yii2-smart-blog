<?php

use yii\helpers\Html;
use plathir\smartblog\common\widgets\RatingWidget;
use \plathir\user\common\helpers\UserHelper;

$userHelper = new UserHelper();

$imageURL = $model->module->ImagePathPreview . '/' . $model->id . '/' . $model->post_image;
?>


<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
    <div class="blog-grid-post">    
        <div class="grid-image">
            <?= Html::a('<img src=' . $model->imageurl . '?>', ['/blog/posts/view', 'id' => $model->id], $options = []); ?>

        </div>
        <div class="title">
            <?php
            if (strlen($model->description) <= 150) {
                $descr = $model->description;
            } else {
                $descr = substr($model->description, 0, 150) . '...';
            }
            ?>

            <?= Html::a($descr, ['/blog/posts/view', 'id' => $model->id], $options = []) ?>
        </div>

        <?php
        if (strlen($model->intro_text) <= 150) {
            $model->intro_text;
        } else {
            echo substr($model->intro_text, 0, 150) . '...<br>';
        }
        echo Html::a(' more »', ['/blog/posts/view', 'id' => $model->id], $options = ['class' => 'btn btn-default']);
        ?>

    </div>
</div>
