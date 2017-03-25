<?php

use yii\helpers\Html;
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
<?php $mycss = '.navbar-default {
  background-color: #3c8dbc;
  border-color: #337ab7;
}
.navbar-default .navbar-brand {
  color: #ecf0f1;
}
.navbar-default .navbar-brand:hover,
.navbar-default .navbar-brand:focus {
  color: #fbfbfb;
}
.navbar-default .navbar-text {
  color: #ecf0f1;
}
.navbar-default .navbar-nav > li > a {
  color: #ecf0f1;
}
.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > li > a:focus {
  color: #fbfbfb;
}
.navbar-default .navbar-nav > .active > a,
.navbar-default .navbar-nav > .active > a:hover,
.navbar-default .navbar-nav > .active > a:focus {
  color: #fbfbfb;
  background-color: #337ab7;
}
.navbar-default .navbar-nav > .open > a,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus {
  color: #fbfbfb;
  background-color: #337ab7;
}
.navbar-default .navbar-toggle {
  border-color: #337ab7;
}
.navbar-default .navbar-toggle:hover,
.navbar-default .navbar-toggle:focus {
  background-color: #337ab7;
}
.navbar-default .navbar-toggle .icon-bar {
  background-color: #ecf0f1;
}
.navbar-default .navbar-collapse,
.navbar-default .navbar-form {
  border-color: #ecf0f1;
}
.navbar-default .navbar-link {
  color: #ecf0f1;
}
.navbar-default .navbar-link:hover {
  color: #fbfbfb;
}

@media (max-width: 767px) {
  .navbar-default .navbar-nav .open .dropdown-menu > li > a {
    color: #ecf0f1;
  }
  .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
  .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
    color: #fbfbfb;
  }
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a,
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
    color: #fbfbfb;
    background-color: #337ab7;
  }
}';
?>
      <div class="layout-top-nav">
      

        <nav class="navbar navbar-static-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <a href="../../index2.html" class="navbar-brand"><b>Admin</b>LTE</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li>
              </ul>
              <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                </div>
              </form>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </div>


<?php
NavBar::begin(['brandLabel' => 'Blog', 'brandUrl' => Url::to('/blog'),
    'containerOptions' => [
    ],
    'options' => [
    ],
    'innerContainerOptions' => [
        'class' => 'container-fluid',
    ],
]);
echo Nav::widget([
    'items' => [
        ['label' => 'Home', 'url' => ['/blog/default/index']],
        ['label' => 'About', 'url' => ['/site/about'],
            'items' => [
                ['label' => 'Test', 'url' => ['/site/about']],
                ['label' => 'Test', 'url' => ['/site/about']],
                ['label' => 'Test', 'url' => ['/site/about']],
                ['label' => 'Test', 'url' => ['/site/about']],
                ['label' => 'Test', 'url' => ['/site/about']],
                ['label' => 'Test', 'url' => ['/site/about']],
            ]
        ],
    ],
    'options' => ['class' => 'navbar-nav'],
]);
NavBar::end();
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

<?= $content ?>

<?php $this->endContent(); ?>


