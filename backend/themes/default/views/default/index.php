<?php

use plathir\smartblog\common\widgets\TagCloudWidget;
use plathir\smartblog\backend\widgets\LatestPosts;
use plathir\smartblog\backend\widgets\MostVisitedPosts;
use yii\helpers\Html;
?>

<div class="smartblog-default-index">
    <div class="panel panel-info">
        <div class="panel-heading">Most Visited Posts</div>
        <div class="panel-body">

            <div class="table-responsive">
                <?= Html::a(Yii::t('app', '<i class="fa fa-folder-open"></i>File Manager'), ['/blog/posts/filemanager'], ['class' => 'btn btn-lg btn-default']) ?>
                <?= Html::a(Yii::t('app', '<i class="fa fa-gears"></i>Settings'), ['/blog/settings'], ['class' => 'btn btn-lg btn-default']) ?>
                <?= Html::a(Yii::t('app', '<i class="fa fa-list"></i>Categories'), ['/blog/category'], ['class' => 'btn btn-lg btn-default']) ?>
                <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i>Posts Preview'), ['/blog/posts/list'], ['class' => 'btn btn-lg btn-default']) ?>
            </div>
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
</div>
