<?php

use yii\helpers\Html;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\Url;
?>


<?php
if (\Yii::$app->view->theme) {
    $layoutFile = \Yii::$app->view->theme->pathMap['@app/views'] . DIRECTORY_SEPARATOR . 'layouts/main.php';
} else {
    $layoutFile = '@app/views/layouts/main.php';
}
?>

<?php $this->beginContent($layoutFile); ?>
<?php
//NavBar::begin(['brandLabel' => 'Blog', 'brandUrl' => Url::to('/blog'),
//    'containerOptions' => [
//    ],
//    'options' => [
//    ],
//    'innerContainerOptions' => [
//        'class' => 'container-fluid',
//    ],
//]);
//echo Nav::widget([
//    'items' => [
//        ['label' => 'Home', 'url' => ['/blog/default/index']],
//        ['label' => 'About', 'url' => ['/site/about'],
//            'items' => [
//                ['label' => 'Test', 'url' => ['/site/about']],
//                ['label' => 'Test', 'url' => ['/site/about']],
//                ['label' => 'Test', 'url' => ['/site/about']],
//                ['label' => 'Test', 'url' => ['/site/about']],
//                ['label' => 'Test', 'url' => ['/site/about']],
//                ['label' => 'Test', 'url' => ['/site/about']],
//            ]
//        ],
//    ],
//    'options' => ['class' => 'navbar-nav'],
//]);
//NavBar::end();
?>     

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
        <?= Html::a(Yii::t('app', '<i class="fa fa-tags"></i>Tags'), ['/blog/tags'], ['class' => 'btn btn-app']) ?>
    </div>
</div>
<?php
?>

<?= $content ?>

<?php $this->endContent(); ?>

