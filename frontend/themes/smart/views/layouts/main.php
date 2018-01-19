<?php

use yii\helpers\Html;
use plathir\widgets\common\helpers\PositionHelper;

$positionHelper = new PositionHelper();
?>


<?php
if (\Yii::$app->view->theme) {
    $layoutFile = \Yii::$app->view->theme->pathMap['@app/views'] . DIRECTORY_SEPARATOR . 'layouts/main.php';
} else {
    $layoutFile = '@app/views/layouts/main.php';
}
?>

<?php $this->beginContent($layoutFile); ?>

<!-- Blog --> 
<div class="blog-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="main-content-header">
<!--                    <h3>Blog Page header <small>Subtext for header</small></h3>-->

                </div> 
            </div>
        </div>

        <div class="row">
            <div class="blog-list-left col-lg-8 col-md-8">  
                <div class="container">
                    <div class="row">
                        <?= $content ?>
                    </div>
                </div>
            </div>

            <div class="blog-sidebar-right col-lg-4 col-md-4 hidden-sm hidden-xs">
                <div class="container">
                    <div class="row">
                        <?= $positionHelper->LoadPosition('fe_blog_dashboard_right'); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $this->endContent(); ?>


