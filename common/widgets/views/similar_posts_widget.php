<?php
use yii\helpers\Html;

echo '<h3>Similar Posts :</h3>';

foreach ($posts as $post) {
    echo Html::a($post->id . '  ' . $post->description, ['view', 'id' => $post->id], []) . '<br>';
}