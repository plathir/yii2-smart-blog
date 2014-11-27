<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'intro_text')->textarea(['rows' => 6]) ?>

    <?php //= //$form->field($model, 'full_text')->textarea(['rows' => 6])  ?>

    <?php

    use vova07\imperavi\Widget;

echo $form->field($model, 'full_text')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'en',
            'minHeight' => 200,
            'pastePlainText' => true,
            'plugins' => [
                'clips',
                'fullscreen'
            ]
        ]
    ]);
    ?>

    <?= $form->field($model, 'intro_image')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'full_image')->textInput() ?>

    <?= $form->field($model, 'user_created')->textInput() ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'user_last_change')->textInput() ?>

    <?= $form->field($model, 'date_last_change')->textInput() ?>

    <?= $form->field($model, 'publish')->textInput() ?>

<?= $form->field($model, 'categories')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
