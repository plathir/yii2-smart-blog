<?php

use plathir\smartblog\common\widgets\TagCloudWidget;
use plathir\smartblog\backend\widgets\LatestPosts;
use plathir\smartblog\backend\widgets\MostVisitedPosts;
use plathir\smartblog\backend\widgets\TopAuthors;
use plathir\smartblog\backend\widgets\TopRated;
use yii\helpers\Html;
?>

<div class="smartblog-default-index">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Posts</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <?= Html::a(Yii::t('app', '<i class="fa fa-folder-open"></i>File Manager'), ['/blog/posts/filemanager'], ['class' => 'btn btn-app']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-gears"></i>Settings'), ['/blog/settings'], ['class' => 'btn btn-app']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-list"></i>Categories'), ['/blog/category'], ['class' => 'btn btn-app']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i>Posts Preview'), ['/blog/posts/list'], ['class' => 'btn btn-app']) ?>
        </div>
    </div>

    <?=
    LatestPosts::widget([
        'latest_num' => 10,
        'Theme' => $Theme,
    ]);
    ?>

    <?=
    MostVisitedPosts::widget([
        'posts_num' => 10,
        'Theme' => $Theme,
    ]);
    ?>
    <div class="row">


        <div class="col-lg-4">
            <?=
            TopAuthors::widget([
                'authors_num' => 10,
                'Theme' => $Theme,
            ]);
            ?>

        </div>

        <div class="col-lg-8">
            <?=
            TopRated::widget([
                'posts_num' => 10,
                'Theme' => $Theme,
            ]);
            ?>

        </div>

    </div>


</div>
