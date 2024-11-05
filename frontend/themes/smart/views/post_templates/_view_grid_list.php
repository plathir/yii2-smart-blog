<?php

use yii\helpers\Html;
use plathir\smartblog\common\widgets\RatingWidget;
use \plathir\user\common\helpers\UserHelper;
use yii\helpers\Url;

$userHelper = new UserHelper();

$imageURL = $model->module->ImagePathPreview . '/' . $model->id . '/' . $model->post_image;
$post_url = urldecode(Url::to(['/blog/posts/view/', 'path' => $model->urlpath, 'id' => $model->id, 'slug' => $model->slug], true));
?>

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="blog-grid-post">    
        <div class="grid-image">
            <?= Html::a('<img src="' . $model->imageurl . '"?>', $post_url, $options = []); ?>
            <!--            <div class="middle">
                            <div class="text">John Doe</div>
                        </div>-->
        </div>
        <div class="title">
            <?php
            if (strlen($model->description) <= 80) {
                $descr = $model->description;
            } else {
                $descr = mb_substr($model->description, 0, 79). '...';
                //$descr = mb_substr($model->description, 0, 150);
            }
            ?>


            <?php
            if (strlen($model->intro_text) <= 150) {
                $intro = $model->intro_text;
            } else {
                $intro = mb_substr($model->intro_text, 0, 79). '...';                
              //  $intro = mb_substr($model->intro_text, 0, 150) . '...';
            }
            ?>            

            <?= Html::a($descr, $post_url, $options = []) ?>
            <h4><small><?= Yii::$app->formatter->asDatetime($model->created_at) ?></small></h4>
        </div>

        <?php
        echo $intro . '<br>';// strlen($intro);
        ?>

    </div>
</div>
