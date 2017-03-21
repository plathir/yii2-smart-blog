<?php

use yii\helpers\Html;
use plathir\smartblog\helpers\PostHelper;
?>
<?php
foreach ($topAuthors as $Author) {
    ?>

    <?= Html::a($Author["author"], ['/blog/posts/userposts', 'userid' => $Author["userid"]]) ?><br>
    <td><?= $Author['cnt'] ?><br>

    <?php } ?>
