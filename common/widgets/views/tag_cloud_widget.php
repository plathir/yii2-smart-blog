<?php

use justinvoelker\tagging\TaggingWidget;
?>
<div class="smartblog-default-index">
    <?php
    if ($widget->title) {
        echo '<h3>' . $widget->title . '</h3>';
    }
    echo TaggingWidget::widget([
        'items' => $widget->tags,
        'url' => [$widget->callbackUrl],
        'urlParam' => 'tag',
        'format' => 'cloud',
    ]);
    ?>

</div>