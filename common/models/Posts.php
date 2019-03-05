<?php
namespace plathir\smartblog\common\models;

use Yii;
use plathir\smartblog\backend\models\PostsRating;
use plathir\smartblog\common\models\Tags;

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
            (new \yii\db\Query())->createCommand()->delete('posts_tags', ['post_id' => $this->id])->execute();
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
                if ($newTag->save()) {
                    $tag_id = $newTag->id;
                }
            }
// Insert new tags            
            if ($tag_id) {
                (new \yii\db\Query())->createCommand()->insert('posts_tags', ['post_id' => $this->id, 'tag_id' => $tag_id])->execute();
            }
        }
    }

//    public function afterFind() {
//        $this->views++;
//        $this->save();
//    }
}
