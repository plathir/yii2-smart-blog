<?php

use kartik\tree\TreeView;
use plathir\smartblog\backend\models\Categorytree;
use yii\helpers\Html;
use yii\grid\GridView;
?>
<div class="panel panel-primary">
    <div class="panel-heading">Categories Tree View</div>
    <div class="panel-body">
        <?php
        echo TreeView::widget([
            // single query fetch to render the tree
            'query' => Categorytree::find()->addOrderBy('root, lft'),
            'headingOptions' => ['label' => 'Categories'],
            'isAdmin' => true, // optional (toggle to enable admin mode)
            'displayValue' => 1, // initial display value
            'softDelete' => true, // normally not needed to change
                //'cacheSettings'   => ['enableCache' => true]      // normally not needed to change
        ]);
        ?>

    </div>
</div>


<div class="panel panel-primary">
    <div class="panel-heading">Categories</div>
    <div class="panel-body">
        <div class="posts-index">

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'name',
                    'description',
                    'image'
                ],
            ]);
            ?>

        </div>
    </div>
</div>