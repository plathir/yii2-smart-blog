<?php

use yii\helpers\Html;

$imageURL = $model->module->ImagePathPreview . '/' . $model->id . '/' . $model->intro_image;
echo Html::a($model->description, ['/blog/posts/view', 'id' => $model->id]);

