<?php
use plathir\smartblog\common\widgets\TagCloudWidget;
use yii\helpers\Html;
?>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $widget->title ?></h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?=
                    TagCloudWidget::widget([
                        'title' => ''
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>



