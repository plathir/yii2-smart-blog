<?php

use yii\helpers\Html;
?>

<?php foreach ($posts as $post) { ?>
    <?= $post->id ?><br>
    <?= Html::a($post->description, ['/blog/posts/view', 'id' => $post->id]) ?><br>
    <?= $post->views ?><br>
    <?= $post->publish ?><br>
    <?= Yii::$app->formatter->asDatetime($post->created_at) ?><br>
<?php } ?>
