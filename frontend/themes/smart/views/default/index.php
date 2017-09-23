<?php
use plathir\widgets\common\helpers\PositionHelper;
$positionHelper = new PositionHelper();


?>
<div class="body-content">
    <div class="row-fluid">
          <?= $positionHelper->LoadPosition('fe_blog_dashboard'); ?>
    </div>
</div>
