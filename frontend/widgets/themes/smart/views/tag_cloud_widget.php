<?php

use plathir\smartblog\common\widgets\TagCloudWidget;
use yii\helpers\Html;
?>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><?= 'Tag Cloud'; ?></h3>
        <div class ="pull-right">
            
        </div>

    </div><!-- /.box-header --> 
    <div class="box-body" style="min-height:250px; max-height:250px; overflow:auto;">
<?=
TagCloudWidget::widget([
    'title' => ''
]);
?>                  
    </div>
</div>


