<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = Yii::t('blog','Static Page').' : ' . $model->id.' - '.$model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog','Static Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->description;
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
        <div class="col-lg-9">

            <p>
                <?= Html::a('<i class="fa fa-pencil-square-o"></i>&nbsp;' . Yii::t('blog','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-success btn-flat']) ?>

                <?=
                Html::a('<i class="fa fa-trash-o"></i>&nbsp;' . Yii::t('blog','Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-flat',
                    'data' => [
                        'confirm' => Yii::t('blog','Are you sure you want to delete this item?'),
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
                        'value' => $model->publish == true ? '<span class="label label-success">'.Yii::t('blog','Published').'</span>' : '<span class="label label-danger">'.Yii::t('blog','Unpublished').'</span>',
                        'format' => 'html'
                    ],
                ],
            ]);
            ?>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading"><?= Yii::t('blog','Translations') ?></div>
                <div class="panel-body">
                    <div class="list-group">
                        <?php
                        $appLanguage = Yii::$app->settings->getSettings('MasterContentLang');
                        foreach (Yii::$app->urlManager->languages as $language) {
                            if ($language != $appLanguage) {

                                switch ($language) {
                                    case 'el':
                                        $temp_lang = 'gr';
                                        break;
                                    case 'en':
                                        $temp_lang = 'gb';
                                        break;
                                    default:
                                        $temp_lang = $language;
                                        break;
                                }
                                ?>
                                <?= Html::a('<i class="fa fa-pencil-square-o"></i>&nbsp;' . Yii::t('blog', 'Translation').' ' . '<img src="https://www.countryflags.io/' . $temp_lang . '/flat/16.png">', ['translate', 'id' => $model->id, 'lang' => $language], ['class' => 'list-group-item list-group-item-info']); ?>
                                <?php
                            }
                        }
                        ?>  
                    </div>
                </div>

            </div>  
        </div>
        <div class="col-lg-12">
            <br><strong><?= Yii::t('blog','Preview') ?> : </strong><br><br>
            <?= $model->full_text; ?>
            <?php
            //   $html = Yii::$app->translate->translate('en-US', 'el', $model->full_text);
            //$transl = Yii::$app->translate->translate('en-us', 'el', $model->full_text);
            //  echo $html['text'][0];
            ?>

        </div>
    </div>
</div>
