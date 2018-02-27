<?php

use yii\widgets\ListView;
?>

<div class="body-content">
    <div class="row">
        <div class="col-lg-12">
            <?php
            $view = '/post_templates/_view_blog_list';
            $layout = '{summary}{items}{pager}';
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                //'itemOptions' => ['class' => 'media'],
                'itemView' => $view,
                'layout' => $layout,
                'summary' => '',
            ]);
            ?>
        </div>
    </div>
</div>