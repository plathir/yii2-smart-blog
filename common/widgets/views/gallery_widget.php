<?php

use yii\imagine\Image;

$galleryArray = json_decode($widget->galleryItems);
if ($galleryArray) {
    echo '<strong>' . $widget->title . '</strong>';


    $items = '';

    foreach ($galleryArray as $image) {

        $items[] = [
            'url' => $widget->previewUrl . '/' . $image,
            'src' => $widget->previewUrl . '/thumbs/' . $image,
            'imageOptions' => [
                'style' => ['max-width' => '200px',
                    'max-height' => '150px',
                ]
            ],
            'options' => ['title' => $image,
                'style' => 'width:200px',
                'class' => 'inline-block'
            ]
        ];
    }
    ?>
    <div>
        <?=
        dosamigos\gallery\Gallery::widget(['items' => $items,
            'options' => [
                'id' => 'gallery-widget1-' . $widget->id,
            ],
            'templateOptions' => [
                'id' => 'blueimp-gallery1-' . $widget->id
            ],
            'clientOptions' => [
                'container' => '#blueimp-gallery1-' . $widget->id
            ]]
        );
    }
    ?>
</div>