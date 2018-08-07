<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\widgets\ListView;

if ($disp_subcat = true) {
    $category_url = urldecode(Url::to(['/blog/posts/categoryall', 'id' => $model->id, 'slug' => $model->slug], true));
} else {
    $category_url = urldecode(Url::to(['/blog/posts/category', 'id' => $model->id, 'slug' => $model->slug], true));
}
?>

<div class="container">
    <div class="row">
        <!-- Left-aligned -->
        <div class="media">
            <div class="media-left">
                <?= Html::a('<img class="media-object image-in-list" src="' . $model->imageUrl . '" alt="...">', $category_url) ?>
            </div>
            <div class="media-body">
                <h4 class="media-heading"><?= Html::a($model->name, $category_url) ?><br></h4>
                <p><?php
                    echo $model->description;
                    ?>
                </p>
            </div>
        </div>
        <br>
    </div>
</div>


