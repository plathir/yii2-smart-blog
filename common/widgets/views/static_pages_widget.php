<?php
if ($widget->displayTitle) {
    echo $model->description . '<br>';
}
if ($widget->displayIntroText) {
    echo $model->intro_text . '<br>';
}
?>

<div class="container-fluid">
    <div class="row">
            <?php
            if ($model->full_text) {
               echo yii\helpers\HtmlPurifier::process($model->full_text);
               echo '<br>';
            }
            ?>
    </div>
</div>
