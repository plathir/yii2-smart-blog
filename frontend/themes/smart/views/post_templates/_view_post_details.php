<?php

use yii\helpers\Html;
use \plathir\user\common\helpers\UserHelper;
use plathir\smartblog\common\widgets\TagsWidget;
use \plathir\smartblog\common\widgets\GalleryWidget;
use plathir\upload\ListFilesWidget;
use plathir\smartblog\common\widgets\RatingWidget;
use yii\helpers\Url;
use dosamigos\disqus\Comments;

$userHelper = new UserHelper();

$post_url = urldecode(Url::to(['/blog/posts/view/', 'path' => $model->urlpath, 'id' => $model->id, 'slug' => $model->slug], true));
$post_url_update = urldecode(Url::to(['/blog/posts/update/', 'path' => $model->urlpath, 'id' => $model->id, 'slug' => $model->slug], true));
?>
<div class="blog-post-details-area">
    <div>
        <div class="post-details-header"><?= Html::a($model->description, $post_url) ?>
            &nbsp;
            <?php
            if  ( \yii::$app->user->can('BlogUpdatePost', ['post' => $model] ) || \yii::$app->user->can('BlogUpdateOwnPost', ['post' => $model]) ) {
                echo Html::a('<i class="fa fa-edit"></i>', $post_url_update, ['class' => 'pull-right btn btn-success btn-sm button-edit']);
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
            <div class="post-details-image-box col-xs-12 col-sm-12 col-lg-12">
                <img class="img-responsive" src="<?= $model->imageurl; ?>">
            </div>

            <div class="blog-intro-text">
                <?= $model->fulltext_html ?> 
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
<?php
if (Yii::$app->settings->getSettings('DisqusShortname') && Yii::$app->settings->getSettings('Comments') ) {
    echo Comments::widget([
        'shortname' => Yii::$app->settings->getSettings('DisqusShortname'),
        'identifier' => $model->id
    ]);
}
?>

<?=
plathir\smartblog\frontend\widgets\SimilarPostsWidget::widget([
    'postID' => $model->id,
]);
?>
