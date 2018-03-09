<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use plathir\smartblog\backend\widgets\CarouselPosts;


/* @var $this yii\web\View */
/* @var $searchModel apps\recipes\backend\models\search\CarouselSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('blog', 'Carousels');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carousel-index">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Yii::t('blog', 'Carousels') ?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <p>
                <?= '' //Html::a(Yii::t('recipes', 'Create Recipes'), ['create'], ['class' => 'btn bg-purple btn-flat margin']) ?>
                <?= Html::a('<i class="fa fa-plus"></i>&nbsp' . Yii::t('blog', 'Create Carousel'), ['create'], ['class' => 'btn btn-primary btn-flat margin']) ?>
            </p>
            <?php Pjax::begin(); ?>
            <?php
            // echo $this->render('_search', ['model' => $searchModel]); 

            $userModel = new $searchModel->module->userModel();
            $user_items = \yii\helpers\ArrayHelper::map($userModel::find()->where('status = 10')->all(), 'id', 'username');
            ?>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    // ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    [
                        'value' => function( $model ) {
                            return CarouselPosts::widget([
                                        'title' => '',
                                        'Theme' => 'smart',
                                        'height' => 100,
                                        'carousel_id' => $model->id]);
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'width: 20%;'],
                    ],
                    'title',
                    'created_at:date',
                    [
                        'attribute' => 'created_by',
                        'value' => function($model, $key, $index, $widget) {
                            return $model->CreatedByName;
                        },
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width: 10%;'],
                        'filter' => \yii\bootstrap\Html::activeDropDownList($searchModel, 'created_by', $user_items, ['class' => 'form-control', 'prompt' => 'Select...'])
                    ],
                    'updated_at:date',
                    [
                        'attribute' => 'updated_by',
                        'value' => function($model, $key, $index, $widget) {
                            return $model->UpdatedByName;
                        },
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width: 10%;'],
                        'filter' => \yii\bootstrap\Html::activeDropDownList($searchModel, 'updated_by', $user_items, ['class' => 'form-control', 'prompt' => 'Select...'])
                    ],                                
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>

        </div>    

    </div>
</div>
