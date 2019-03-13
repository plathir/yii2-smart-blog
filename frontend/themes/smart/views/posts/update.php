<?php

use yii\data\ArrayDataProvider;
use yii\widgets\ListView;
?>
<div class="body-content">
    <div class="row-fluid">
        <?php
        $view = '/post_templates/_post_form';

        echo $this->render($view, [
            'model' => $model,
            'modelLang' => $modelLang,
        ])
        ?>
    </div>
</div>