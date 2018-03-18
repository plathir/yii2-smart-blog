<?php

use plathir\widgets\common\helpers\PositionHelper;

$positionHelper = new PositionHelper();
?>
<div class="body-content">
    <div class="row">
        <div class="col-lg-12">        
            <?= $positionHelper->LoadPosition('fe_blog_dashboard'); ?>
        </div>
    </div>
</div>
