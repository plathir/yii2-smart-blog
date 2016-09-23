<?php

use yii\widgets\ActiveForm;
use kartik\widgets\StarRating;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col xs-12">
        <?php if ($ratemodel->last_ip != Yii::$app->request->getUserIP()) {
            ?>
            <?php Pjax::begin(['id' => 'post-rating', 'enablePushState' => false]); ?>
            <?php
            $form = ActiveForm::begin([ 'options' => ['enctype' => 'multipart/form-data', 'name' => 'UpdPostrate', 'data-pjax' => true, 'method' => 'post']]);
            ?>
            <?=
            $form->field($ratemodel, 'temprate')->widget(StarRating::classname(), [
                'pluginOptions' => [
                    'defaultCaption' => 'test',
                    'min' => 0,
                    'max' => 5,
                    'step' => 1,
                    'size' => 'xs']]);
            ?>


            <div class="form-group">
                <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Rate this Post', ['class' =>  'btn btn-sm btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>        
            <?php Pjax::end(); ?>        

            <?php
        } else {
            echo StarRating::widget([
                'name' => 'post_rating',
                'value' => $ratemodel->temprate,
                'pluginOptions' => [
                    'displayOnly' => true,
//                    'size' => '10px']
                    'size' => 'xs']
                                ]);
            echo '<span class="label label-info">already rate this post !</span>';
        }
        ?>

    </div>

</div>
