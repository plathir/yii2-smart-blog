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
                        <th></th>
                        <th>Post ID</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($posts) {
                        foreach ($posts as $post) {
                            ?>
                            <tr>
                                <td>
                                    <?=
                                    Html::img($post->ImageUrlThumb, ['alt' => '...',
                                        'width' => '50',
                                        'align' => 'center']);
                                    ?>
                                </td>
                                <td><?= $post->id ?></td>
                                <td><?= Html::a($post->description, ['/blog/posts/view', 'id' => $post->id]) ?></td>
                                <td><?= $post->publishbadge ?></td>
                                <td><?= Yii::$app->formatter->asDatetime($post->created_at) ?></td>
                            </tr>
                        <?php }
                    }
                    ?>
                </tbody>
            </table>
        </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
        <?= Html::a(Yii::t('app', 'Create New Post'), ['/blog/posts/create'], ['class' => 'btn btn-sm btn-info btn-flat pull-left']) ?>  
<?= Html::a(Yii::t('app', 'View All Posts'), ['/blog/posts'], ['class' => 'btn btn-sm btn-default btn-flat pull-right']) ?>
    </div><!-- /.box-footer -->
</div><!-- /.box -->        
