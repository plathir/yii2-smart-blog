<?php

use yii\data\ArrayDataProvider;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="body-content">
    <div class="row">
        <div class="col-lg-12">

            <?php
            $view = '/post_templates/_view_blog_list';

            $provider = new ArrayDataProvider([
                'allModels' => $posts,
                'pagination' => [
                    'pageSize' => 3,
                ],
            ]);

            $layout = '{summary}{items}<div class="row-fluid">{pager}</div>';
//            Pjax::begin();
            echo ListView::widget([
                'dataProvider' => $provider,
                //'itemOptions' => ['class' => 'media'],
                'itemOptions' => ['class' => 'item'],
                'itemView' => $view,
                'layout' => $layout,
                'summary' => '',
//                'pager' => ['class' => \kop\y2sp\ScrollPager::className(),
//                    'triggerOffset' => 5
//                ]
            ]);
//            Pjax::end();
            ?>
        </div>
    </div>
</div>

