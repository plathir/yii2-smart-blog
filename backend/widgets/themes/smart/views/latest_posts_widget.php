<?php

use yii\helpers\Html;
?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Latest Posts</h3>
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
                        <th>Status</th>
                        <th>Created Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post) { ?>
                        <tr>
                            <td><?= $post->id ?></td>
                            <td><?= Html::a($post->description, ['/blog/posts/view', 'id' => $post->id]) ?></td>
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
        <?= Html::a(Yii::t('app', 'Create New Post'), ['/blog/posts/create'], ['class' => 'btn btn-sm btn-info btn-flat pull-left']) ?>  
        <?= Html::a(Yii::t('app', 'View All Posts'), ['/blog/posts'], ['class' => 'btn btn-sm btn-default btn-flat pull-right']) ?>
    </div><!-- /.box-footer -->
</div><!-- /.box -->        
