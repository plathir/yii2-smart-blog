<?php

use yii\helpers\Html;
use \plathir\user\common\helpers\UserHelper;
use plathir\smartblog\common\widgets\TagsWidget;
use \plathir\smartblog\common\widgets\GalleryWidget;
use plathir\upload\ListFilesWidget;

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
            <?php if (\yii::$app->user->can('BlogUpdatePost')) { ?>
                <div class="pull-right btn btn-success"><i class="fa fa-edit"></i> Edit</div>
                <?php
            }
            ?>

        </div>
    </div>
    <div class="post-details-author-info">
        Written by <?= $userHelper->getProfileFullName($model->user_created) ?>
        <img class="img-circle img-responsive post-author-image" src="<?= $userHelper->getProfileImage($model->user_created, $this) ?>">
        <div class="post-details-header-small pull-right"><i class="fa fa-fw fa-clock-o"></i><?= Yii::$app->formatter->asDatetime($model->created_at) ?></div>        
    </div>

    <div>   
        <div class="row">
            <div class="post-details-image-box col-xs-12 col-sm-5 col-lg-4">
                <img class="img-responsive" src="<?= $imageURL; ?>">

            </div>

            <div class="blog-intro-text">
                <?= $model->full_text ?> 
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?=
                GalleryWidget::widget([
                    'galleryItems' => $model->gallery,
                    'imagePath' => $model->module->ImagePath . '/' . $model->id,
                    'previewUrl' => $model->module->ImagePathPreview . '/' . $model->id,
                ]);
                ?>
                <br>
                <strong><?= Yii::t('blog', 'Attachments :') ?> </strong><br>
                <?=
                ListFilesWidget::widget([
                    'model' => $model,
                    'previewUrl' => $model->module->ImagePathPreview,
                    'KeyFolder' => $model->id,
                    'attribute' => 'attachments',
                ]);
                ?>
                <br>
                <?=
                TagsWidget::widget([
                    'tags' => $model->tags,
                ]);
                ?>
            </div>
        </div>

    </div>
</div>