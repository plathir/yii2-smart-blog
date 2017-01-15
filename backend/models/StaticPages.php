<?php

namespace plathir\smartblog\backend\models;

use plathir\cropper\behaviors\UploadImageBehavior;
use plathir\upload\behaviors\MultipleUploadBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;

class StaticPages extends \plathir\smartblog\common\models\StaticPages {

    use \plathir\smartblog\backend\traits\ModuleTrait;

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
                'attribute' => 'description',
                'slugAttribute' => 'slug',
                'ensureUnique' => true,
            ],
        ];
    }

    public function getRoute() {    
        return ['static-pages/view', 'id' => $this->id, 'slug' => $this->slug];
    }

    public function getUrl() {
        return \yii\helpers\Url::to($this->getRoute());
    }

}
