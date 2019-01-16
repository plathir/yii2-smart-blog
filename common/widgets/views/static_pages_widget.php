<?php
if ($widget->displayTitle) {
    echo $model->description . '<br>';
}
if ($widget->displayIntroText) {
    echo $model->intro_text . '<br>';
}
?>

<?php
if ($model->css && $model->code_editor) {
    echo $this->registerCss($model->css);
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
