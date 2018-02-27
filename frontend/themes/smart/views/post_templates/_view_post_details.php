<?php

use yii\helpers\Html;
use \plathir\user\common\helpers\UserHelper;
use plathir\smartblog\common\widgets\TagsWidget;
use \plathir\smartblog\common\widgets\GalleryWidget;
use plathir\upload\ListFilesWidget;
use plathir\smartblog\common\widgets\RatingWidget;

$userHelper = new UserHelper();

$imageURL = $model->module->ImagePathPreview . '/' . $model->id . '/' . $model->post_image;
?>

<div class="blog-post-details-area">
    <div>
        <div class="post-details-header"><?= Html::a($model->description, ['/blog/posts/view', 'id' => $model->id]) ?>
            &nbsp;
            <?php
            if (\yii::$app->user->can('BlogUpdatePost')) {
                echo Html::a('<i class="fa fa-edit"></i>', ['/blog/posts/update', 'id' => $model->id], ['class' => 'pull-right btn btn-success btn-sm button-edit']);
            }
            ?>
        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?=
        RatingWidget::widget([
            'post_id' => $model->id,
            'size' => 'cust',
        ]);
        ?>               
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 post-details-author-info">
        <img class="img-circle img-responsive post-author-image" src="<?= $userHelper->getProfileImage($model->user_created, $this) ?>">
        <?= $userHelper->getProfileFullName($model->user_created) ?>
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
                <?php
                if ($model->gallery) {
                    echo GalleryWidget::widget([
                        'galleryItems' => $model->gallery,
                        'imagePath' => $model->module->ImagePath . '/' . $model->id,
                        'previewUrl' => $model->module->ImagePathPreview . '/' . $model->id,
                    ]);
                }
                ?>
                <?php if ($model->attachments) { ?>
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
                <?php } ?>
                <?php if ($model->tags) { ?>
                    <?=
                    TagsWidget::widget([
                        'tags' => $model->tags,
                    ]);
                    ?>
                <?php } ?>
            </div>
        </div>

    </div>
</div>

<?=
plathir\smartblog\frontend\widgets\SimilarPostsWidget::widget([
    'postID' => $model->id,
]);
?>