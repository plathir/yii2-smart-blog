<?php

use yii\data\ArrayDataProvider;
use yii\widgets\ListView;

$this->title = 'Create Posts';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="body-content">
    <div class="row-fluid">
        <?php
        $view = '/post_templates/_post_form';

        echo $this->render($view, [
            'model' => $model,
        ])
        ?>
    </div>
</div>