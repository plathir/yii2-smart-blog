<?php

use yii\helpers\Html;
?>
<div class="panel panel-primary">
    <div class="panel-heading"><?php echo $widget->title ?></div>
    <div class="panel-body">

        <div class="table-responsive">
            <table class="table">
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
    <div class="panel-footer">
        <?= Html::a(Yii::t('app', 'Create New Post'), ['/blog/posts/create'], ['class' => 'btn btn-sm btn-primary']) ?>  
        <?= Html::a(Yii::t('app', 'View All Posts'), ['/blog/posts'], ['class' => 'btn btn-sm btn-default pull-right']) ?>
    </div><!-- /.box-footer -->
</div><!-- /.box -->        
