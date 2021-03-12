<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\tree\TreeView;
use yii\bootstrap\Tabs;
?>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Yii::t('blog', 'Categories') ?></h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>

    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="posts-index">
            <?php
            echo Tabs::widget([
                'items' => [
                    [
                        'label' => Yii::t('blog', 'Categories'),
                        'content' => '<br>' . TreeView::widget([
                            // single query fetch to render the tree
                            'query' => \plathir\smartblog\backend\models\Categorytree::find()->addOrderBy('root, lft'),
                            'nodeAddlViews' => [
                                kartik\tree\Module::VIEW_PART_2 => '/categorytree/_category_extra_fields'
                            ],
                            'headingOptions' => ['label' => Yii::t('kvtree', 'Categories')],
                            'isAdmin' => true, // optional (toggle to enable admin mode)
                            'displayValue' => 1, // initial display value
                            'softDelete' => true, // normally not needed to change
                            'hideCssClass' => 'hidden',
                            'showInactive' => true,
                            'cacheSettings' => ['enableCache' => false], // normally not needed to change
                        ]),
                    ],
                    [
                        'label' => Yii::t('blog', 'Extra fields'),
                        'content' => '<br>' . GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                [
                                    'header' => 'Name',
                                    'format' => 'html',
                                    'value' => function($model, $key, $index, $grid) {
                                        $lvlVal = '';
                                        for ($x = 0; $x < $model->lvl; $x++) {
                                            if ($x == 0) {
                                                $lvlVal .= str_repeat('&nbsp;', 5);
                                            };
                                            $lvlVal .= '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
                                        }
                                        if ($lvlVal == '') {
                                            $lvlVal .= '<span class="glyphicon glyphicon-tree-conifer" aria-hidden="true"></span>';
                                            $lvlVal .= $model->name;
                                        } else {

                                            $lvlVal .= '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>' . $model->name;
                                        }
                                        return $lvlVal;
                                    }
                                ],
                                'id',
                                [
                                    'attribute' => 'active',
                                    'value' => function($model, $key, $index, $widget) {
                                        return $model->active == true ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
                                    },
                                    'format' => 'html',
                                    'filter' => \yii\bootstrap\Html::activeDropDownList($searchModel, 'active', ['0' => 'Inactive', '1' => 'Active'], ['class' => 'form-control', 'prompt' => 'Select...']),
                                    'contentOptions' => ['style' => 'width: 10%;']
                                ],
                                'description',
                                [
                                    'header' => 'Image',
                                    'format' => 'raw',
                                    'value' => function($model, $key, $index, $grid) {
                                        if ($model->image) {
                                            //                                        return $model->module->CategoryImagePathPreview . '/' . $model->id . '/' . $model->image;

                                            return Html::img($model->module->CategoryImagePathPreview . '/' . $model->id . '/' . $model->image, ['alt' => '...',
                                                        // 'class' => 'img-circle',
                                                        'width' => '50',
                                                        'align' => 'center']);
                                        } else {
                                            return '';
                                        }
                                    }
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{update}',
                                ]
                            ],
                        ]),
                    ],
                ]
            ]);
            ?>
        </div>
    </div>
</div>