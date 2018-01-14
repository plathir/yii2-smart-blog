<?php

use yii\helpers\Html;
use plathir\smartblog\helpers\PostHelper;
use plathir\user\common\helpers\UserHelper;

$userHelper = new UserHelper();

?>
<div class="box box-danger">
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
                        <th><?= Yii::t('blog', 'Author Name') ?></th>
                        <th><?= Yii::t('blog', 'Count') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($topAuthors as $Author) {
                        ?>
                        <tr>
                            <td> 
                        <?= Html::img($userHelper->getProfileImage($Author["userid"], $this), ['alt' => '...',
                                        'class' => 'img-circle',
                                        'width' => '30',
                                        'align' => 'center']); ?>
                            </td>
                            <td><?= Html::a($Author["author"], ['/blog/posts/userposts', 'userid' => $Author["userid"]]) ?></td>
                            <td><?= $Author['cnt'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
    </div><!-- /.box-footer -->
</div><!-- /.box -->        
