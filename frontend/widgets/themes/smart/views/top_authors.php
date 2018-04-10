<?php

use yii\helpers\Html;
use plathir\smartblog\helpers\PostHelper;
use plathir\user\common\helpers\UserHelper;

$userHelper = new UserHelper();
?>


<div class="panel panel-default">
    <div class="panel-heading"><?= Yii::t('blog', 'Top Authors') ?></div>
    <div class="panel-body"> 
        <div class="table-responsive">
            <table class="table no-margin">
                <thead>

                </thead>
                <tbody>
                    <?php
                    if ($topAuthors) {
                        foreach ($topAuthors as $Author) {
                            ?>
                            <tr>
                                <td> 
                                    <?=
                                    Html::img($userHelper->getProfileImage($Author["userid"], $this), ['alt' => '...',
                                        'class' => 'img-circle',
                                        'width' => '40',
                                        'align' => 'center']);
                                    ?>
                                </td>
                                <td><?= Html::a($Author["author"], ['/blog/posts/userposts', 'userid' => $Author["userid"]]) ?></td>
                                <td><?= $Author['cnt'] ?></td>
                            </tr>
                        <?php }
                    }
                    ?>
                </tbody>
            </table>
        </div><!-- /.table-responsive -->
    </div>
</div>

