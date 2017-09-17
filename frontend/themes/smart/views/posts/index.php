<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Posts_s */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="body-content">
    <div class="row-fluid   ">
        <?php foreach ($posts as $post) { ?>
            <div class="box box-info"style="min-height:350px; max-height: 350px">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Html::a($post->description, ['/blog/posts/view', 'id' => $post->id]) ?></h3>
                    <div class ="pull-right">
                        <i class="fa fa-fw fa-clock-o"></i> <?= Yii::$app->formatter->asDatetime($post->created_at) ?>
                    </div>

                </div><!-- /.box-header --> 
                <div class="box-body" style="min-height:250px; max-height:250px; overflow:auto;">
                    <div>
                        <div class="pull-left" style="width: 210px">
                            <?php $imageURL = $post->module->ImagePathPreview . '/' . $post->id . '/' . $post->intro_image; ?>
                            <img src="<?= $imageURL; ?>" style="max-width:200px" >
                            Created by : <?= $post->user_created; ?>
                        </div>

                        <?= $post->intro_text ?>    
                        
                    </div>
                </div>
                <div class="box-footer">
                    <?= Html::a(Yii::t('app', 'More &raquo;'), ['/blog/posts/view', 'id' => $post->id], ['class' => 'btn btn-sm btn-default btn-flat pull-left']) ?>  
                </div>
            </div>

            <?php
        }
        ?>
    </div>
</div>
