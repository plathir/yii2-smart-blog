<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = Yii::t('blog','Update Static Page').' : ' . ' ' . $model->id.' - '. $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Static Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="posts-update">
    <?=
    $this->render('_form', [
        'model' => $model,
        'modelLang' => $modelLang,
    ])
    ?>

</div>
