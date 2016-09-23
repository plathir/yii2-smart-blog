<?php
use kartik\widgets\StarRating;
use yii\helpers\Html;

?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Most Rated Posts</h3>
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
                        <th>Rate</th>
                        <th>Created Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post) { ?>
                        <tr>
                            <td><?= $post->id ?></td>
                            <td><?= Html::a($post->description, ['/blog/posts/view', 'id' => $post->id]) ?></td>
                            <td><?= StarRating::widget([
                            'name' => 'post_rating',
                            'value' => $post->ratingval,
                            'pluginOptions' => [
                                'displayOnly' => true,
                                'size' => '15px']
                        ]);
                             ?></td>
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
