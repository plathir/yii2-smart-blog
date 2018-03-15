<?php

use yii\bootstrap\Carousel;
use yii\helpers\Html;

if ($widget->title) {
  //  echo '<h3>' . $widget->title . '</h3>';
};
$items = [];
foreach ($posts as $post) {
    $items[] = [
        // equivalent to the above
        'content' => '<img src="' . $post->imageUrl . '" max-height: ' . $widget->height . '; width="100%"/>',
        // the item contains both the image and the caption
        'caption' => '<div style="background:rgba(0, 0, 0, 0.2);"><h4><u>' . Html::a($post->description, ['/blog/posts/view', 'id' => $post->id], ['style' => "color:white;"]) . '</u></h4><p>' . $post->intro_text . '</p></div>',
        'options' => ['style' => "width:100%; height: " . $widget->height . ";"]
    ];
}

if ($items) {
    echo Carousel::widget([
        'items' => $items,
        'controls' => ['<span class="glyphicon glyphicon-chevron-left"></span>', '<span class="glyphicon glyphicon-chevron-right"></span>'],
        'options' => ['style' => "width:100%; height: " . $widget->height . ";"],
    ]);
}



