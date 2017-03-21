<?php

use yii\helpers\Html;
use plathir\widgets\common\helpers\PositionHelper;
$positionHelper = new PositionHelper();

?>

<div class="smartblog-default-index">

    <div class="row">
        <div class="col-lg-12">        
            <?= $positionHelper->LoadPosition('be_blog_position1'); ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-4">
            <?= $positionHelper->LoadPosition('be_blog_position2'); ?>
        </div>
        <div class="col-lg-8">
             <?= $positionHelper->LoadPosition('be_blog_position3'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= $positionHelper->LoadPosition('be_blog_position4'); ?>
        </div>  
    </div>
    
</div>

