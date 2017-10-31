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
<div class="col-lg-9 col-md-9 col-sm-8">
    <?= $content ?>

</div>

<div class="col-lg-3 col-md-3 col-sm-4  hidden-xs">
    <?= $positionHelper->LoadPosition('fe_blog_dashboard_right'); ?>

</div>


<?php $this->endContent(); ?>


