<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = 'Create Static Page';
$this->params['breadcrumbs'][] = ['label' => 'Static Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelLang' => $modelLang,
    ])
    ?>

</div>
