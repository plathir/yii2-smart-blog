<?php
namespace plathir\smartblog\backend\models;

use plathir\cropper\behaviors\UploadImageBehavior;
use plathir\upload\behaviors\MultipleUploadBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use plathir\smartblog\backend\models\PostsLang;
use Yii;
use yii\helpers\Markdown;
use plathir\smartblog\backend\models\Categorytree;
use yii\helpers\Inflector;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;

class Posts extends \plathir\smartblog\common\models\Posts {

    use \plathir\smartblog\backend\traits\ModuleTrait;

    public $descr;

    public function behaviors() {
        return ArrayHelper::merge(
                        parent::behaviors(), [
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
                            'post_image' => [
                                'path' => $this->module->ImagePath,
                                'temp_path' => $this->module->ImageTempPath,
                                'url' => $this->module->ImagePathPreview,
                                'key_folder' => 'id',
                            ],
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
                        'slugAttribute' => 'slug',
                        'ensureUnique' => true,
                        'value' => function($event) {
                            if ($this->slugdescr) {
                               return Inflector::slug($this->slugdescr);
                            } else {
                                
                                //throw new InvalidConfigException('slugdescr is null');
                            }
                        }
                    ],
        ]);
    }
}
