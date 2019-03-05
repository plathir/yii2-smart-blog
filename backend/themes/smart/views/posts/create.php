<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = 'Create Posts';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
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
