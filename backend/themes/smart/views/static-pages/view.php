<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = 'Static Page : ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Static Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>

    </div><!-- /.box-header -->
    <div class="box-body">

        <p>
            <?= Html::a('<i class="fa fa-pencil-square-o"></i>&nbsp;' . 'Update', ['update', 'id' => $model->id], ['class' => 'btn btn-success btn-flat']) ?>
            <?=
            Html::a('<i class="fa fa-trash-o"></i>&nbsp;' . 'Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-flat',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </p>

        <?php
        if ($model->css && $model->code_editor) {
            echo $this->registerCss($model->css);
        }
        ?>

        <?php
        $userModel = new $model->module->userModel();
        $categoryModel = new plathir\smartblog\backend\models\Category();
        ?>


        <?php
        //echo Html::a('test', \yii\helpers\Url::to(['posts/view', 'id' => $model->id, 'slug' => $model->slug]));

        echo DetailView::widget([
            'model' => $model,
            'template' => '<tr><th style="width:20%">{label}</th><td style="width:80%">{value}</td></tr>',
            'attributes' => [
                'id',
                'description',
                'slug',
                'intro_text:ntext',
//                            'full_text:html',
                [
                    'attribute' => 'user_created',
                    'value' => $userModel::findOne(['id' => $model->user_created])->{$model->module->userNameField},
                    'format' => 'text'
                ],
                'created_at:datetime',
                [
                    'attribute' => 'user_last_change',
                    'value' => $userModel::findOne(['id' => $model->user_last_change])->{$model->module->userNameField},
                    'format' => 'html'
                ],
                'updated_at:datetime',
                [
                    'attribute' => 'publish',
                    'value' => $model->publish == true ? '<span class="label label-success">Published</span>' : '<span class="label label-danger">Unpublished</span>',
                    'format' => 'html'
                ],
            ],
        ]);
        ?>
        <br><strong>Preview : </strong><br><br>
        <?= $model->full_text; ?>
        <?php

        $transl = Yii::$app->translate->translate('en', 'el', $model->full_text);
        echo $transl['text'][0];

        ?>

    </div>
</div>
