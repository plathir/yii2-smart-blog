<?php

use yii\data\ArrayDataProvider;
use yii\widgets\ListView;

?>
<div class="body-content">
    <div class="row-fluid">
        <?php
        $view = '/post_templates/_view_blog_list';

        $provider = new ArrayDataProvider([
            'allModels' => $posts,
//            'pagination' => [
//                'pageSize' => 3,
//            ],
        ]);

        $layout = '{summary}{items}{pager}';

        echo
        ListView::widget([
            'dataProvider' => $provider,
            //'itemOptions' => ['class' => 'media'],
            'itemView' => $view,
            'layout' => $layout,
            'summary' => '',
        ]);
        ?>
    </div>
</div>
