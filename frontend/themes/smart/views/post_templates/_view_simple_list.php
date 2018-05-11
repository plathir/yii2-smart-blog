<?php

use yii\helpers\Html;

$imageURL = $model->module->ImagePathPreview . '/' . $model->id . '/' . $model->post_image;
echo Html::a($model->description, ['/blog/posts/view', 'id' => $model->id, 'slug' => $model->slug]);

