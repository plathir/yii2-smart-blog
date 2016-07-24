<?php

use yii\grid\GridView;
use kartik\tree\TreeView;
use yii\bootstrap\Tabs;
?>

<div class="panel panel-primary">
    <div class="panel-heading">Categories</div>
    <div class="panel-body">
        <div class="posts-index">

            <?=
            Tabs::widget([
                'items' => [
                    [
                        'label' => 'Category Tree Admin',
                        'content' => TreeView::widget([
                            // single query fetch to render the tree
                            'query' => \plathir\smartblog\backend\models\Categorytree::find()->addOrderBy('root, lft'),
                            'headingOptions' => ['label' => 'Categories'],
                            'isAdmin' => true, // optional (toggle to enable admin mode)
                                //  'displayValue' => 1, // initial display value
                                //'softDelete'      => true,                        // normally not needed to change
                                //'cacheSettings'   => ['enableCache' => true]      // normally not needed to change
                        ]),
                    ],
                    [
                        'label' => 'Extra fields',
                        'content' => GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                'name',
                                'description',
                                'image'
                            ],
                        ]),
                    ],
                ]
            ]);

            use iutbay\yii2kcfinder\KCFinderInputWidget;

            echo KCFinderInputWidget::widget([
                'name' => 'image',
                'kcfOptions' => [
                    'uploadURL' => $searchModel->module->CategoryImagePathPreview,
                    'uploadDir' => $searchModel->module->CategoryImageTempPath,
                ]
            ]);
            ?>



        </div>
    </div>
</div>