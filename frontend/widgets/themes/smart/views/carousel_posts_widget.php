<?php

use yii\bootstrap\Carousel;
use yii\helpers\Html;
use yii\web\View;

if ($widget->title) {
    //  echo '<h3>' . $widget->title . '</h3>';
};
$items = [];
foreach ($posts as $post) {

    if (strlen($post->Description) < 150) {
        $descr = $post->Description;
    } else {
        $descr = mb_substr($post->Description, 0, 100) . '...';
    }

    if (strlen($post->intro_text) < 150) {
        $intro = $post->intro_text;
    } else {
        $intro = mb_substr($post->intro_text, 0, 149) . '...';
    }

    $items[] = [
        // equivalent to the above
        'content' => '<img src="' . $post->imageUrl . '" max-height: ' . $widget->height . '; width="100%"/>',
        // the item contains both the image and the caption
        'caption' => '<div style="background:rgba(0, 0, 0, 0.2);"><h4><u>' . Html::a($descr, ['/blog/posts/view', 'id' => $post->id, 'slug' => $post->slug], ['style' => "color:white;"]) . '</u></h4><p>' . $intro . '</p></div>',
        'options' => ['style' => "width:100%; height: " . $widget->height . "; swipe: 30;"]
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

// Swipe Carousel
//$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js', ['depends' => 'yii\web\JqueryAsset']);
//
//
//$this->registerJs('$(".carousel").swipe({
//  swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
//    if (direction == "left") $(this).carousel("next");
//    if (direction == "right") $(this).carousel("prev");
//  },
//  allowPageScroll:"vertical"
//
//});', View::POS_END);

