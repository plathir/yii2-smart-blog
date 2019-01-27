<?php

namespace plathir\smartblog\backend\models;

use plathir\cropper\behaviors\UploadImageBehavior;
use plathir\upload\behaviors\MultipleUploadBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use plathir\smartblog\backend\models\StaticPagesLang;
use Yii;
use yii\helpers\Inflector;

class StaticPages extends \plathir\smartblog\common\models\StaticPages {

    use \plathir\smartblog\backend\traits\ModuleTrait;

    public $descr;
    public function behaviors() {
        return [
            'timestampBehavior' =>
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => function() {
                    return date('U');
                }
            ],
            'slagBehavior' => [
                'class' => SluggableBehavior::className(),
                // 'attribute' => 'description',
                'slugAttribute' => 'slug',
                'ensureUnique' => true,
                'value' => function($event) {
                    return Inflector::slug($this->descr);
                }
            ],
        ];
    }

    public function getRoute() {
        return ['static-pages/view', 'id' => $this->id, 'slug' => $this->slug];
    }

    public function getUrl() {
        return \yii\helpers\Url::to($this->getRoute());
    }

    public function getLangtext() {
        return $this->hasMany(StaticPagesLang::className(), ['id' => 'id']);
    }

    public function getDescription() {
        $descr = '';
        foreach ($this->langtext as $texts) {
            if ($texts->lang == Yii::$app->language) {
                $descr = $texts->description;
            }
        }
        // $this->descr = $descr;
        return $descr;
    }

    public function getFull_text() {
        $full_text = '';
        foreach ($this->langtext as $texts) {
            if ($texts->lang == Yii::$app->language) {
                $full_text = $texts->full_text;
            }
        }

        return $full_text;
    }

    public function getIntro_text() {
        $intro_text = '';
        foreach ($this->langtext as $texts) {
            if ($texts->lang == Yii::$app->language) {
                $intro_text = $texts->intro_text;
            }
        }
        return $intro_text;
    }
}
