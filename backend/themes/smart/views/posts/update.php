<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = Yii::t('blog','Update Post') . ': ' . $model->id.'-'.$model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog','Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('blog','Update');
?>
<div class="posts-update">
    <?=
    $this->render('_form', [
        'model' => $model,
        'modelLang' => $modelLang,
    ])
    ?>

</div>
