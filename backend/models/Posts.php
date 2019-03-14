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
                        // 'attribute' => 'description',
                        'slugAttribute' => 'slug',
                        'ensureUnique' => true,
                        'value' => function($event) {

                            if ($this->slugdescr) {
                                return Inflector::slug($this->slugdescr);
                            } else {
                                throw new InvalidConfigException('slugdescr is null');
                            }
                        }
                    ],
        ]);
    }

    function getImageUrl() {
        if ($this->post_image) {
            return Yii::getAlias($this->module->ImagePathPreview) . '/' . $this->id . '/' . $this->post_image;
        } else {
            return Yii::getAlias($this->module->ImagePathPreview) . '/nophoto.png';
        }
    }

    function getImageUrlThumb() {
        if ($this->post_image) {
            return Yii::getAlias($this->module->ImagePathPreview) . '/' . $this->id . '/thumbs/' . $this->post_image;
        } else {
            return Yii::getAlias($this->module->ImagePathPreview) . '/nophoto_thumb.png';
        }
    }

    public function getPublishbadge() {
        $badge = '';
        switch ($this->publish) {
            case 0:
                $badge = '<span class="label label-danger">Unpublished</span>';
                break;
            case 1:
                $badge = '<span class="label label-success">Published</span>';
                break;
            default:
                break;
        }

        return $badge;
    }

    public function getFulltext_html() {

        switch ($this->module->editor) {
            case 'CKEditor':
                return $this->full_text;
            case 'markdown':
                return Markdown::process($this->full_text, 'gfm');
        }
    }

    public function getUrlpath() {
        $category = Categorytree::findOne($this->category);
        return $category->path;
    }

    public function getRoute() {
        return ['posts/view', 'id' => $this->id, 'slug' => $this->slug];
    }

    public function getUrl() {
        return \yii\helpers\Url::to($this->getRoute());
    }

    public function getLangtext() {
        return $this->hasMany(PostsLang::className(), ['id' => 'id']);
    }

    public function getDescription() {

        $descr = '';
        $main_descr = '';
        foreach ($this->langtext as $texts) {
            if ($texts->lang == Yii::$app->language) {
                $descr = $texts->description;
            }
            if ($texts->lang == Yii::$app->settings->getSettings('MasterContentLang')) {
                $main_descr = $texts->description;
            }
        }
        if (!$descr) {
            $descr = $main_descr;
        }

        return $descr;
    }

    public function getSlugdescr() {
        $main_descr = '';
        foreach ($this->langtext as $texts) {
            if ($texts->lang == Yii::$app->settings->getSettings('MasterContentLang')) {
                $main_descr = $texts->description;
            }
        }

        if ((!$main_descr) && ($this->descr)) {
            return $this->descr;
        } else {
            return $main_descr;
        }
    }

    public function getFull_text() {
        $full_text = '';
        $main_full_text = '';
        foreach ($this->langtext as $texts) {
            if ($texts->lang == Yii::$app->language) {
                $full_text = $texts->full_text;
            }
            if ($texts->lang == Yii::$app->settings->getSettings('MasterContentLang')) {
                $main_full_text = $texts->full_text;
            }
        }

        if (!$full_text) {
            $full_text = $main_full_text;
        }
        return $full_text;
    }

    public function getIntro_text() {
        $intro_text = '';
        $main_intro_text = '';
        foreach ($this->langtext as $texts) {
            if ($texts->lang == Yii::$app->language) {
                $intro_text = $texts->intro_text;
            }
            if ($texts->lang == Yii::$app->settings->getSettings('MasterContentLang')) {
                $main_intro_text = $texts->intro_text;
            }
        }

        if (!$intro_text) {
            $intro_text = $main_intro_text;
        }
        return $intro_text;
    }

}
