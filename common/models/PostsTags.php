<?php

namespace plathir\smartblog\common\models;

/**
 * This is the model class for table "smartblog_posts".
 *
 * @property integer $post_id
 * @property integer $tag_id
 * */
class PostsTags extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%posts_tags}}';
    }

    
    public function getTagname()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tag_id'])->select(['name'])->one();
    }
}
