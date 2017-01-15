<?php

use yii\helpers\Html;
?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo $widget->title ?></h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Post ID</th>
                        <th>Description</th>
                        <th>Visits</th>
                        <th>Status</th>
                        <th>Created Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post) { ?>
                        <tr>
                            <td><?= $post->id ?></td>
                            <td><?= Html::a($post->description, ['/blog/posts/view', 'id' => $post->id]) ?></td>
                            <td><?= 100 ?></td>
                            <?php if ($post->publish) { ?>
                                <td><span class="label label-success">Published</span></td>
                            <?php } else { ?>
                                <td><span class="label label-danger">Unpublished</span></td>
                            <?php } ?>  
                            <td><?= Yii::$app->formatter->asDatetime($post->created_at) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
    </div><!-- /.box-footer -->
</div><!-- /.box -->        
