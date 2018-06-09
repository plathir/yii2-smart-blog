<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Posts_s */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    foreach ($dataProvider->getModels() as $pdata) {
        ?>
        <div class="row">
            <div class ="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="row">

                    <div class="col-lg-12">
                        <?php echo Html::a('<h1>' . $pdata['description'] . '</h1>', ['view', 'id' => $pdata['id']]); ?>
                    </div>
                    <div class ="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <?php
                        if ($pdata['post_image'] != null) {
                            echo "<img src=" . plathir\smartblog\backend\helpers\PostHelper::getPostIntroImage($pdata['id']) . " class='pull-left img-responsive' style='width:100%'>";
                        }
                        ?>
                    </div>
                    <div class ="col-lg-9 col-md-8 col-sm-8 col-xs-12"> 
                        <div class="row"> 
                            <?php echo substr($pdata['intro_text'], 0, 300); ?>
                            <?php
                            if (strlen($pdata['intro_text']) > 300) {
                                echo "...";
                            }
                            ?>
                        </div>   

                        <div class ="row" style="padding-top: 15px">
                            <?php echo Html::a('More &raquo;', ['view', 'id' => $pdata['id']], ['class' => 'btn btn-default']); ?>
                        </div>   
                    </div>
                </div>

                <hr>                
            </div>
        </div>
        <?php
    }
    ?>

</div>
