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
            <!--            <div class="middle">
                            <div class="text">John Doe</div>
                        </div>-->
        </div>
        <div class="title">
            <?php
            if (strlen($model->description) < 150) {
                $descr = $model->description;
            } else {
                $descr = substr($model->description, 0, 150) . '...';
            }
            ?>


            <?php
            if (strlen($model->intro_text) < 150) {
                $intro = $model->intro_text;
            } else {
                $intro = substr($model->intro_text, 0, 150) . '...';
            }
            ?>            

            <?= Html::a($descr, ['/blog/posts/view', 'id' => $model->id], $options = []) ?>
            <h4><small><?= Yii::$app->formatter->asDatetime($model->created_at) ?></small></h4>
        </div>

        <?php
        echo $intro . '<br>';// strlen($intro);
        ?>

    </div>
</div>
