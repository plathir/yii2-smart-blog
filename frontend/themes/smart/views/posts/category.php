<?php
use yii\widgets\ListView;

$this->title = $category;
$this->params['breadcrumbs'][] = ['label' => 'Index', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="body-content">
    <div class="row">
        <div class="col-lg-12">
            <?php
            $view = '/post_templates/_view_media_list';
            $layout = '{summary}{items}{pager}';
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                //'itemOptions' => ['class' => 'media'],
                'itemView' => $view,
                'layout' => $layout,
                'summary' => '',
            ]);
            ?>
        </div>
    </div>
</div>