<?php

namespace plathir\smartblog\common\models;

use Yii;
use plathir\smartblog\backend\models\PostsRating;
use plathir\smartblog\common\models\Tags;
use plathir\smartblog\common\models\PostsLang;
use plathir\smartblog\backend\models\Categorytree;

/**
 * This is the model class for table "smartblog_posts".
 *
 * @property integer $id
 * @property string $description
 * @property string $slug
 * @property string $post_image
 * @property integer $user_created
 * @property string $created_at
 * @property integer $user_last_change
 * @property string $updated_at
 * @property integer $publish
 * @property integer $category
 * @property string $tags
 * @property string $attachments
 * @property string $gallery
 * @property integer $views
 */
class Posts extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%posts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_created', 'category'], 'required'],
            [['tags'], 'string'],
            [['attachments'], 'string'],
            [['gallery'], 'string'],
            [['post_image'], 'string'],
            [['user_created', 'user_last_change', 'publish'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['category', 'views'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('blog', 'ID'),
            'slug' => Yii::t('blog', 'Slug'),
            'post_image' => Yii::t('blog', 'Image'),
            'intro_text' => Yii::t('blog', 'Intro Text'),
            'full_text' => Yii::t('blog', 'Full Text'),
            'user_created' => Yii::t('blog', 'User Created'),
            'created_at' => Yii::t('blog', 'Date Created'),
            'user_last_change' => Yii::t('blog', 'User Last Change'),
            'updated_at' => Yii::t('blog', 'Date Last Change'),
            'publish' => Yii::t('blog', 'Publish'),
            'category' => Yii::t('blog', 'Category'),
            'tags' => Yii::t('blog', 'Tags'),
            'attachments' => Yii::t('blog', 'Attachments'),
            'gallery' => Yii::t('blog', 'Gallery'),
            'views' => Yii::t('blog', 'Views'),
            'description' => Yii::t('blog', 'Description'),
            'fulltext_html' => Yii::t('blog', 'Fulltext html'),
        ];
    }

    public function getRating() {
        return $this->hasOne(PostsRating::className(), ['post_id' => 'id']);
    }

    public function getRatingval() {
        if ($this->rating != null) {
            if ($this->rating->rating_count > 0) {
                return round($this->rating->rating_sum / $this->rating->rating_count);
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

// Delete tags if exist        
        if (!$this->isNewRecord) {
            (new \yii\db\Query())->createCommand()->delete('{{%posts_tags}}', ['post_id' => $this->id])->execute();
        }
        $temp_tags = explode(',', $this->tags);
        foreach ($temp_tags as $tag) {

            if ($temp_tag = Tags::find()->where(['name' => $tag])->one()) {
                $tag_id = $temp_tag->id;
            } else {
                $tag_id = null;
            }
            if (!$tag_id) {
                $newTag = new Tags();
                $newTag->name = $tag;
                $newTag->posts_cnt = 1;
                if ($newTag->save()) {
                    $tag_id = $newTag->id;
                }
            }
// Insert new tags            
            if ($tag_id) {
                (new \yii\db\Query())->createCommand()->insert('{{%posts_tags}}', ['post_id' => $this->id, 'tag_id' => $tag_id])->execute();
            }
        }
    }


    public function getTexts() {
        return $this->hasMany(PostsLang::className(), ['id' => 'id']);
    }

    function getImageUrl() {
        if ($this->post_image) {
            return Yii::getAlias($this->module->ImagePathPreview) . '/' . $this->id . '/' . $this->post_image;
        } else {
            return $this->module->assetBundle->baseUrl . '/img/nophoto.png';
         //   return Yii::getAlias($this->module->ImagePathPreview) . '/nophoto.png';
        }
    }

    function getImageUrlThumb() {
        if ($this->post_image) {
            return Yii::getAlias($this->module->ImagePathPreview) . '/' . $this->id . '/thumbs/' . $this->post_image;
        } else {
            return $this->module->assetBundle->baseUrl . '/img/nophoto_thumb.png';
        }
    }
    
    public function getPublishbadge() {
        $badge = '';
        switch ($this->publish) {
            case 0:
                $badge = '<span class="label label-danger">'.Yii::t('blog','Unpublished').'</span>';
                break;
            case 1:
                $badge = '<span class="label label-success">'.Yii::t('blog','Published').'</span>';
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
