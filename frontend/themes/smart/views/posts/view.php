<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use plathir\upload\ListFilesWidget;
use yii\bootstrap\Tabs;
use plathir\smartblog\common\widgets\TagsWidget;
use \plathir\smartblog\common\widgets\SimilarPostsWidget;
use \plathir\smartblog\common\widgets\GalleryWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="body-content">
    <div class="row-fluid   ">
        <div class="box box-info" >
            <div class="box-header with-border">
                <h3 class="box-title"><?= $model->description ?></h3>
                <div class ="pull-right">
                    <i class="fa fa-fw fa-clock-o"></i> <?= Yii::$app->formatter->asDatetime($model->created_at) ?>
                </div>

            </div><!-- /.box-header --> 
            <div class="box-body">
                <div class="pull-left" style="width: 210px">
                    <img style="max-width:200px"  src="<?= $model->imageUrl ?>">
                    
                </div>                
                   <?= $model->full_text . '<br>' ?>
                   <?= 'Created By :' .$model->user_created . ' at : ' . Yii::$app->formatter->asDatetime($model->created_at) . '<br>' ?>
                   <?= 'Updated By :' .$model->user_created . ' at : ' . Yii::$app->formatter->asDatetime($model->updated_at) . '<br>' ?>
                   <?= 'Tags :' .$model->tags  ?>
            </div>
        </div>
    </div>
</div>