<?php

use yii\helpers\Html;
use yii\web\View;
?>
<div class="body-content">
    <?php
    $numOfCols = 4;
    $rowCount = 0;
    $bootstrapColWidth = 12 / $numOfCols;
    $test = 0.
    ?>
    <div class="row-fluid   ">
        <?php foreach ($posts as $post) { ?>
            <div class="box box-info"style="min-height:350px; max-height: 350px">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Html::a($post->description, ['/blog/posts/view', 'id' => $post->id]) ?></h3>
                    <div class ="pull-right">
                        <i class="fa fa-fw fa-clock-o"></i> <?= Yii::$app->formatter->asDatetime($post->created_at) ?>
                    </div>

                </div><!-- /.box-header --> 
                <div class="box-body" style="min-height:250px; max-height:250px; overflow:auto;">
                    <div>
                        <div class="pull-left" style="width: 210px">
                            <?php $imageURL = $post->module->ImagePathPreview . '/' . $post->id . '/' . $post->intro_image; ?>
                            <img src="<?= $imageURL; ?>" style="max-width:200px" >
                            Created by : <?= $post->user_created; ?>
                        </div>

                        <?= $post->intro_text ?>    
                    </div>
                </div>
                <div class="box-footer">
                    <?= Html::a(Yii::t('app', 'More &raquo;'), ['/blog/posts/view', 'id' => $post->id], ['class' => 'btn btn-sm btn-default btn-flat pull-left']) ?>  
                </div>
            </div>

            <?php
//            $rowCount++;
//            if ($rowCount % $numOfCols == 0)
//                echo '</div><div class="row">';
        }
        ?>
    </div>
</div>

<?php
//$this->registerJs(
//        "$(document).ready(function () {
//        $(window).on('resize', function () {
//            var winWidth = $(window).width();
//            if (winWidth < 768) {
//                console.log('Window Width: ' + winWidth + 'class used: col-xs');
//            } else if (winWidth <= 991) {
//                console.log('Window Width: ' + winWidth + 'class used: col-sm');
//            } else if (winWidth <= 1199) {
//                console.log('Window Width: ' + winWidth + 'class used: col-md');
//            } else {
//                console.log('Window Width: ' + winWidth + 'class used: col-lg');
//            }
//        });
//    });", View::POS_READY
//);
