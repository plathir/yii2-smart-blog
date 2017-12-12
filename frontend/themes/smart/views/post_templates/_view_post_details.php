<?php

use yii\helpers\Html;
use \plathir\user\common\helpers\UserHelper;

$userHelper = new UserHelper();

$imageURL = $model->module->ImagePathPreview . '/' . $model->id . '/' . $model->intro_image;
?>

<div class="blog-post-details-area">
    <div>
        <div class="post-details-header"><?= Html::a($model->description, ['/blog/posts/view', 'id' => $model->id]) ?>
            &nbsp;
            <div class="stars">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>                                            
            </div>            
            <div class="post-details-header-small pull-right"><i class="fa fa-fw fa-clock-o"></i><?= Yii::$app->formatter->asDatetime($model->created_at) ?></div>
        </div>
    </div>
    <div class="post-details-author-info">
        Written by <?= $userHelper->getProfileFullName($model->user_created ) ?>
        <img class="img-circle img-responsive post-author-image" src="<?= $userHelper->getProfileImage($model->user_created, $this) ?>">
        at kldsjflkj
    </div>
    <hr>
    <div>   
        <div class="row">
            <div class="post-details-image-box col-xs-12 col-sm-5 col-lg-4">
                <img class="img-responsive" src="<?= $imageURL; ?>">
            </div>
            <div class="blog-intro-text">
                <?= $model->full_text ?> 
            </div>
        </div>
    </div>
</div>