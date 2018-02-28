<?php

use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\widgets\ListView;

?>      
<div class="body-content">
    <div class="row-fluid">
        <?php
        //  $view = $widget->FrontEndPath . '/post_templates/_view_' . $widget->typeView . '_list.php';
        $view = $widget->TemplatePath . '/post_templates/_view_' . $widget->typeView . '_list.php';
        //$view = 'post_templates/_view_' . $widget->typeView . '_list.php';
        $provider = new ArrayDataProvider([
            'allModels' => $posts,
//            'pagination' => [
//                'pageSize' => 3,
//            ],
        ]);

//        if ($widget->typeView == 'media') {
//            $layout = '<div class="container">
//                    <div class="row">
//                        <div class="panel panel-default">
//                            <div class="panel-heading">' . Yii::t('blog', 'Most Visted Posts') . '</div>
//                            <div class="panel-body">
//                                {items}
//                           </div>
//                        </div>
//                    </div>
//                </div>';
//        } else {
        $layout = '{summary}{items}{pager}';
//        }

        echo '<h3>Similar Posts </h3><hr>';

        echo
        ListView::widget([
            'dataProvider' => $provider,
            //  'itemOptions' => ['class' => 'media'],
            'itemView' => function ($model, $key, $index, $widget) use ($view) {
                return $this->render($view, ['model' => $model]);
            },
            'layout' => $layout,
            'summary' => '',
        ]);
        ?>
    </div>
</div>