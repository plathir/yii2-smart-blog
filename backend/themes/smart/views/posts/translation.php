<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = Yii::t('blog', 'Translate Post : ') . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Translate';
?>


<div class="posts-update">
    <?=
    $this->render('_form_translate', [
        'model' => $model,
        'modelLang' => $modelLang,
    ])
    ?>

</div>
