<?php

use yii\widgets\ListView;
use \plathir\user\common\helpers\UserHelper;

$usrHelper = new UserHelper();
        
?>

<div class="body-content">
    <h3><?= Yii::t('blog', 'Posts Lists for user : ') . '<br><img class="img-circle" src="' . $usrHelper->getProfileImage($userid, $this). '" style="width:200px">' . '<br>' . $usrHelper->getProfileFullName($userid). '('. $username . ')' ?></h3> 
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <?php
            $view = '/post_templates/_view_blog_list';
            $layout = '{summary}{items}{pager}';
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                //'itemOptions' => ['class' => 'media'],
                'itemView' => $view,
                'layout' => $layout,
                'summary' => '',
            ]);
            ?>
        </div>
    </div>
</div>