<?php

use plathir\smartblog\common\widgets\TagCloudWidget;
use yii\helpers\Html;
?>

<div class="panel panel-default">
    <div class="panel-heading"><?= Yii::t('blog', 'Tag Cloud') ?></div>
    <div class="panel-body">  
        <?=
        TagCloudWidget::widget([
            'title' => ''
        ]);
        ?>                  
    </div>
</div>


