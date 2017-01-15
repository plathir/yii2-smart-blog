<?php

use yii\helpers\Html;
use yii\grid\GridView;
?>

<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Tags</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <?= Html::a(Yii::t('app', '<i class="fa fa-gears"></i>Rebuild Tags'), ['/blog/tags/tagsrebuild'], ['class' => 'btn btn-app']) ?>    
    </div>
</div>




<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-tags"></i>&nbsp&nbsp Tags List</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>

    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table no-margin'],
                'columns' => [
                    'id',
                    [
                        'attribute' => 'name',
                        'label' => 'Tag Name',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return Html::a('<i class="fa fa-tag"></i>&nbsp&nbsp' . $data["name"], ['/blog/posts/tags', 'tag' => $data["name"]]);
                        },
                            ],                    
                    [
                        'attribute' => 'postcnt',
                        'label' => 'Posts Count',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return Html::a($data["postcnt"], ['/blog/posts/tags', 'tag' => $data["name"]]);
                        },
                            ]
                        ],
                    ]);
                    ?>

        </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
    </div><!-- /.box-footer -->
</div><!-- /.box -->        
