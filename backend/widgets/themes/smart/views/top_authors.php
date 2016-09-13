<?php

use yii\helpers\Html;
use plathir\smartblog\helpers\PostHelper;

?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Top Authors</h3>
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
                        <th>Author ID</th>
                        <th>Author Name</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($topAuthors as $Author) {
                        ?>
                       <tr>
                            <td><?= Html::a($Author["userid"], [''])   ?></td>
                            <td><?= Html::a($Author["author"], [''])   ?></td>
                            <td><?= $Author['cnt']   ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
    </div><!-- /.box-footer -->
</div><!-- /.box -->        
