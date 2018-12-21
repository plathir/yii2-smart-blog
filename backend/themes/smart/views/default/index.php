<?php

use yii\helpers\Html;
use plathir\widgets\common\helpers\PositionHelper;
use plathir\widgets\common\helpers\LayoutHelper;

$positionHelper = new PositionHelper();
?>

<div class="smartblog-default-index">
    <?php
    $layoutHelper = new LayoutHelper();
    echo $layoutHelper->LoadLayout(__FILE__);
    ?>
</div>