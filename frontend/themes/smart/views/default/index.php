<?php
use plathir\widgets\common\helpers\PositionHelper;
$positionHelper = new PositionHelper();

echo 'Index of Blog Posts';
?>

<div class="row">
    <div class="col-lg-12">        
        <?= $positionHelper->LoadPosition('fe_blog_dashboard1'); ?>
    </div>
</div>  