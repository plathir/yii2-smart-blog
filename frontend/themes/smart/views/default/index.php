<?php

use plathir\widgets\common\helpers\PositionHelper;
use plathir\widgets\common\helpers\LayoutHelper;

$positionHelper = new PositionHelper();

?>
<div class="body-content">
    <?php
   
    $layoutHelper = new LayoutHelper();
    echo $layoutHelper->LoadLayout(__FILE__);
    ?>
</div>
