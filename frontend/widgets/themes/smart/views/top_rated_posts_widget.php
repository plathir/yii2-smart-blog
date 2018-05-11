<?php

use kartik\widgets\StarRating;
use yii\helpers\Html;
?>
<?php echo $widget->title ?><br>

<?php
if ($posts) {
    foreach ($posts as $post) {
        ?>

        <?= $post->id ?><br>
        <?= Html::a($post->description, ['/blog/posts/view', 'id' => $post->id, 'id' => $post->slug]) ?><br>
        <?=
        StarRating::widget([
            'name' => 'post_rating',
            'value' => $post->ratingval,
            'pluginOptions' => [
                'displayOnly' => true,
                'size' => '15px']
        ]);
        ?><br>
        <?= Yii::$app->formatter->asDatetime($post->created_at) ?><br>
    <?php }
}
?>
