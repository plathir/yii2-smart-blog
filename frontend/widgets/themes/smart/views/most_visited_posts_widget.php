<?php

use yii\helpers\Html;
?>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><?= 'Most Visited posts'; ?></h3>
        <div class ="pull-right">
            
        </div>

    </div><!-- /.box-header --> 
    <div class="box-body" style="min-height:250px; max-height:250px; overflow:auto;">
        <?php foreach ($posts as $post) { ?>
            <?= '' //$post->id ?>
            <?= Html::a($post->description, ['/blog/posts/view', 'id' => $post->id]) ?><br>
            <?= ''// $post->views ?>
            <?= '' //$post->publish ?>
            <?= '' //Yii::$app->formatter->asDatetime($post->created_at) ?>
        <?php } ?>                    
    </div>
</div>


