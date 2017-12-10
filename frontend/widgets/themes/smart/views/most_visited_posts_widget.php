<?php

use yii\helpers\Html;
?>

<div class="panel panel-default hidden-xs hidden-sm">
    <div class="panel-heading"><?= Yii::t('blog', 'Most Visited Posts') ?></div>
    <div class="panel-body">  
        <?php foreach ($posts as $post) { ?>
            <?= '' //$post->id ?>
            <?= Html::a($post->description, ['/blog/posts/view', 'id' => $post->id]) ?><br>
            <?= ''// $post->views ?>
            <?= '' //$post->publish ?>
            <?= '' //Yii::$app->formatter->asDatetime($post->created_at) ?>
        <?php } ?>                    
    </div>
</div>


