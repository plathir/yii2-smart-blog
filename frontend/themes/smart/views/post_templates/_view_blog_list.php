<?php

use yii\helpers\Html;

$imageURL = $model->module->ImagePathPreview . '/' . $model->id . '/' . $model->intro_image;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-heading-title"><?= Html::a($model->description, ['/blog/posts/view', 'id' => $model->id]) ?>
            &nbsp;
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>                                            
            <div class="panel-heading-details pull-right"><i class="fa fa-fw fa-clock-o"></i><?= Yii::$app->formatter->asDatetime($model->created_at) ?></div></div>
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
        <?= Html::a(Yii::t('blog', 'More &raquo;'), ['/blog/posts/view', 'id' => $model->id], ['class' => 'btn btn-default']) ?> 
    </div>
</div>
