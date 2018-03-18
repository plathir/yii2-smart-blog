<?php

use yii\bootstrap\Carousel;
use yii\helpers\Html;

if ($widget->title) {
    //  echo '<h3>' . $widget->title . '</h3>';
};
$items = [];
foreach ($posts as $post) {

    if (strlen($post->description) <= 150) {
        $descr = $post->description;
    } else {
        $descr = substr($post->description, 0, 149) . '...';
    }

    if (strlen($post->intro_text) <= 150) {
        $intro = $post->intro_text;
    } else {
        $intro = substr($post->intro_text, 0, 149) . '...';
    }

    $items[] = [
        // equivalent to the above
        'content' => '<img src="' . $post->imageUrl . '" max-height: ' . $widget->height . '; width="100%"/>',
        // the item contains both the image and the caption
        'caption' => '<div style="background:rgba(0, 0, 0, 0.2);"><h4><u>' . Html::a($descr, ['/blog/posts/view', 'id' => $post->id], ['style' => "color:white;"]) . '</u></h4><p>' . $intro . '</p></div>',
        'options' => ['style' => "width:100%; height: " . $widget->height . ";"]
    ];
}

if ($items) {
    echo Carousel::widget([
        'items' => $items,
        'controls' => ['<span class="glyphicon glyphicon-chevron-left"></span>', '<span class="glyphicon glyphicon-chevron-right"></span>'],
        'options' => ['style' => "width:100%; height: " . $widget->height . ";"],
    ]);
    echo '<br>';
}



