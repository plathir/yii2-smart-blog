<?php

use yii\data\ArrayDataProvider;
use yii\widgets\ListView;
?>
<div class="body-content">
    <div class="row-fluid">
        <?php
        $view = '/post_templates/_view_post_details';

        echo $this->render($view, [
            'model' => $model,
        ])
        ?>
    </div>
</div>
