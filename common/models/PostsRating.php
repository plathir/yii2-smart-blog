<?php

namespace plathir\smartblog\common\models;

use Yii;

/**
 * @property integer $post_id
 * @property integer $rating_sum
 * @property integer $rating_count
 * @property string $last_ip
 */
class PostsRating extends \yii\db\ActiveRecord {
      public $temprate;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%posts_rating}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['post_id'], 'required'],
            [['post_id', 'rating_sum', 'rating_count', 'temprate'], 'integer'],
            [['last_ip'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'post_id' => Yii::t('blog', 'Post ID'),
            'rating_sum' => Yii::t('blog', 'Rating Sum'),
            'rating_count' => Yii::t('blog', 'Rating Count'),
            'last_ip' => Yii::t('blog', 'Last IP Address'),
        ];
    }

    public function getTemprate() {
     return 100;     
        
    }
    
    public function getTemprateval() {
        if ($this->post_id) {
            if ($this->rating_count > 0) {
                return round($this->rating_sum / $this->rating_count);
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

}
