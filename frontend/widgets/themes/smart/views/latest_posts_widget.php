<?php

use yii\helpers\Html;
?>
<?php foreach ($posts as $post) { ?>
    <?= $post->id ?><br>
    <?= Html::a($post->description, ['/blog/posts/view', 'id' => $post->id]) ?><br>
    <?= $post->publish ?></td>
    <?= Yii::$app->formatter->asDatetime($post->created_at) ?><br>
<?php } ?>
<?= Html::a(Yii::t('app', 'Create New Post'), ['/blog/posts/create']) ?>  
<?= Html::a(Yii::t('app', 'View All Posts'), ['/blog/posts']) ?>
