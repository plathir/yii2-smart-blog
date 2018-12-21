<?php

use yii\helpers\Html;
use plathir\widgets\common\helpers\PositionHelper;
use plathir\widgets\common\helpers\LayoutHelper;

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
                    <?php
                    ?>
                    <?php
                    if (\Yii::$app->user->can('BlogCreatePost')) {
                        ?>
                        <p>
                            <?=
                            Html::a(Html::tag('span', '<i class="fa fa-fw fa-plus"></i>' . '&nbsp' . Yii::t('blog', 'Create New Post'), [
                                        'title' => Yii::t('blog', 'Create New Post'),
                                        'data-toggle' => 'tooltip',
                                    ]), ['/blog/posts/create'], ['class' => 'btn btn-primary'])
                            ?>                  
                        </p>
                    <?php } ?>
                </div> 
            </div>
        </div>

        <?php
        $layoutHelper = new LayoutHelper();
        echo $layoutHelper->LoadLayout(__FILE__, $content);
        ?>        
    </div>
</div>

<?php $this->endContent(); ?>


