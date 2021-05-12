<?php

use yii\helpers\Html;
use plathir\user\common\helpers\UserHelper;
use yii\data\ArrayDataProvider;
use yii\widgets\ListView;
?>


<div class="body-content">
    <div class="row-fluid">
        <?php
//        $view = $widget->TemplatePath . '/category_templates/_view_category_' . $widget->typeView . '_list.php';
        $view = '/category_templates/_view_category_' . $widget->typeView . '_list.php';
        $provider = new ArrayDataProvider([
            'allModels' => $Categories,
//            'pagination' => [
//                'pageSize' => 3,
//            ],
        ]);

        if ($widget->typeView == 'media') {
            $layout = '<div class="blog-sidebar-right">
                <div class="container">
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">' . Yii::t('blog', 'Categories') . '</div>
                            <div class="panel-body">
                                {summary}{items}{pager}
                           </div>
                        </div>
                    </div>
                </div>
            </div>';
        } else {
            if ($widget->typeView == 'grid') {
                $layout = '<div class="row">{summary}{items}{pager}</div>';
            } else {
                $layout = '<div class="container"><div class="row">{summary}{items}{pager}</div></div>';
            }
        }

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






<!--<div class="panel panel-default">
    <div class="panel-heading"><?= ''; //Yii::t('blog', 'Top Categories') ?></div>
    <div class="panel-body"> 
        <div class="table-responsive">
            <table class="table no-margin">
                <thead>

                </thead>
                <tbody>-->
                    <?php '';
//                    if ($Categories) {
//                        echo '<pre>';
//                        foreach ($Categories as $Category) {
//                            echo $Category->name . '<br>';
//                        }
//                        ///print_r($Categories);
//                        echo '</pre>';
//                    }
                    ?>
<!--                </tbody>
            </table>
        </div> /.table-responsive 
    </div>
</div>-->

