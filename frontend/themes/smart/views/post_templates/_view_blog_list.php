<?php

use yii\helpers\Html;
use plathir\smartblog\common\widgets\RatingWidget;
use \plathir\user\common\helpers\UserHelper;

$userHelper = new UserHelper();

$imageURL = $model->module->ImagePathPreview . '/' . $model->id . '/' . $model->post_image;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-heading-title"><?= Html::a($model->description, ['/blog/posts/view', 'id' => $model->id]) ?>  </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="panel-heading-stars">
                        <?=
                        RatingWidget::widget([
                            'post_id' => $model->id,
                            'onlyDisplay' => true,
                            'size' => 'cust',
                        ]);
                        ?> 
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <div class="panel-heading-details pull-right"><i class="fa fa-fw fa-clock-o"></i><?= Yii::$app->formatter->asDatetime($model->created_at) ?>
                        &nbsp;
                        <?php
                        if (\yii::$app->user->can('BlogUpdatePost')) {
                            echo Html::a('<i class="fa fa-edit"></i>', ['/blog/posts/update', 'id' => $model->id], ['class' => 'pull-right btn btn-success btn-xs']);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body">   
        <div class="row  blog-post-area">
            <div class="col-xs-12 col-sm-5 col-lg-4 post-image-box">
                <img class="img-responsive" src="<?= $imageURL; ?>">
            </div>
            <div class="blog-intro-text">
                <?= $model->intro_text ?> 
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-lg-12 blog-post-area-footer">
                <div class="author-info">
                    <img class="img-circle img-responsive post-author-image" src="<?= $userHelper->getProfileImage($model->user_created, $this) ?>">
                    <?= $userHelper->getProfileFullName($model->user_created) ?>
                </div>
                <div class="pull-right">
                    <?= Html::a(Yii::t('blog', 'More &raquo;'), ['/blog/posts/view', 'id' => $model->id], ['class' => 'btn btn-default']) ?> 
                </div>
            </div>
        </div>  
    </div>
</div>
