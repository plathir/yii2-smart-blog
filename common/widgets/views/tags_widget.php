<?php
use justinvoelker\tagging\TaggingWidget;

echo '<h3>'.$widget->title.'</h3>';
echo
TaggingWidget::widget([
    'items' => array_count_values(array_values(explode(',', $widget->tags))),
    'url' => [$widget->callbackUrl],
    'urlParam' => 'tag',
    'format' => 'cloud',
    'linkOptions' => ['class' => $widget->linkClass],
]);
