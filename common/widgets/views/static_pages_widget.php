<?php
if ($widget->displayTitle) {
    echo $model->description . '<br>';
}
if ($widget->displayIntroText) {
    echo $model->intro_text . '<br>';
}
echo yii\helpers\HtmlPurifier::process($model->full_text ) . '<br>';

