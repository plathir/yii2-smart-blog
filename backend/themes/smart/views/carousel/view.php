<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use kartik\sortinput\SortableInput;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model apps\recipes\backend\models\Carousel */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Carousels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="carousel-view">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>

        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <p>
                        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?=
                        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ])
                        ?>
                    </p>

                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'title',
                            'created_at:date',
//                            'created_by',
                            'CreatedByName',
                            'updated_at:date',
                            //    'updated_by',
                            'UpdatedByName',
                        ],
                    ])
                    ?>
                </div>
                <div class="col-lg-6">
                    <?php
                    echo plathir\smartblog\backend\widgets\CarouselPosts::widget([
                        'title' => 'Preview : ',
                        'Theme' => 'smart',
                        'carousel_id' => $model->id,
                        'height' => '200px',
                    ]);
                    ?>
                </div>
            </div>

            <p>

            </p>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('blog','Items') ?></h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>

                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">

                        <?php
                        $postsList = ArrayHelper::map(plathir\smartblog\backend\models\Posts::find()->all(), 'id', 'description');
                        ?>
                        <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

                        <div class="col-sm-9">
                            <?= $form->field($newItem, 'post_id')->dropDownList($postsList) ?>
                        </div>
                        <div class="col-sm-3">

                            <div class="form-group">
                                <?= Html::submitButton(Yii::t('blog', 'Add'), ['class' => 'btn btn-success']) ?>
                            </div>                        
                        </div>

                        <?php ActiveForm::end(); ?>                            

                        <?php
                        $dataProviderItems = new ArrayDataProvider([
                            'allModels' => $model->carouselItems,
                            'pagination' => [
                                'pageSize' => 20,
                            ],
                        ]);

                        echo GridView::widget([
                            'dataProvider' => $dataProviderItems,
                            //    'filterModel' => $searchModel,
                            'columns' => [
                                //   'id',
                                [
                                    'attribute' => 'post_id',
                                    'value' => function($model) {
                                        $post = plathir\smartblog\backend\models\Posts::findOne($model->post_id);
                                        if ($post) {
                                            return $post->id . '-' . $post->description;
                                        }
                                    }
                                ],
                                [
                                    'value' => function($model) {
                                        $buttonDelete = Html::a(Yii::t('blog', 'Delete'), ['deleteitem', 'id' => $model->id], [
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'data' => [
                                                        'confirm' => Yii::t('blog', 'Are you sure you want to delete this item?'),
                                                        'method' => 'post',
                                                    ],
                                        ]);
                                        return $buttonDelete;
                                    },
                                    'format' => 'raw'
                                ]
                            ],
                        ]);
                        ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>