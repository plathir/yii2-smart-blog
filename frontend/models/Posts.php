<?php

namespace plathir\smartblog\frontend\models;

use plathir\cropper\behaviors\UploadImageBehavior;
use plathir\upload\behaviors\MultipleUploadBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use Yii;

class Posts extends \plathir\smartblog\common\models\Posts {

    use \plathir\smartblog\frontend\traits\ModuleTrait;

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
            'uploadImageBehavior' => [
                'class' => UploadImageBehavior::className(),
                'attributes' => [
                    'intro_image' => [
                        'path' => $this->module->ImagePath,
                        'temp_path' => $this->module->ImageTempPath,
                        'url' => $this->module->ImagePathPreview,
                        'key_folder' => 'id',
                    ],
                    'full_image' => [
                        'path' => $this->module->ImagePath,
                        'temp_path' => $this->module->ImageTempPath,
                        'url' => $this->module->ImagePathPreview,
                        'key_folder' => 'id',
                    ]
                ]
            ],
            'uploadFileBehavior' => [
                'class' => MultipleUploadBehavior::className(),
                'attributes' => [
                    'attachments' => [
                        'path' => $this->module->ImagePath,
                        'temp_path' => $this->module->ImageTempPath,
                        'url' => $this->module->ImagePathPreview,
                        'key_folder' => 'id',
                    ],
                    'gallery' => [
                        'path' => $this->module->ImagePath,
                        'temp_path' => $this->module->ImageTempPath,
                        'url' => $this->module->ImagePathPreview,
                        'key_folder' => 'id',
                        'galleryType' => true,
                    ],
                ]
            ],
            'slagBehavior' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'description',
                'slugAttribute' => 'slug',
                'ensureUnique' => true,
            ],                   
                    
        ];
    }
    
        function getImageUrl() {
        if ( $this->full_image) {
            return Yii::getAlias($this->module->ImagePathPreview) . '/' . $this->id . '/'. $this->full_image;
        } else {
//            return Yii::getAlias($this->module->ImagePathPreview) . '/nophoto.png'. $this->image;
        }
    }

}
