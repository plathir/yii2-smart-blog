<?php

use yii\helpers\Html;
use plathir\smartblog\common\widgets\RatingWidget;
use \plathir\user\common\helpers\UserHelper;
use yii\helpers\Url;

$userHelper = new UserHelper();

$imageURL = $model->module->ImagePathPreview . '/' . $model->id . '/' . $model->post_image;
$post_url = urldecode(Url::to(['/blog/posts/view/', 'path' => $model->urlpath, 'id' => $model->id, 'slug' => $model->slug], true));
?>

<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
    <div class="blog-grid-post">    
        <div class="grid-image">
            <?= Html::a('<img src=' . $model->imageurl . '?>', $post_url, $options = []); ?>
            <!--            <div class="middle">
                            <div class="text">John Doe</div>
                        </div>-->
        </div>
        <div class="title">
        
            <?= Html::a($descr, $post_url, $options = []) ?>
            <h4><small><?= Yii::$app->formatter->asDatetime($model->created_at) ?></small></h4>
        </div>

        <?php
        echo $intro . '<br>';// strlen($intro);
        ?>

    </div>
</div>
