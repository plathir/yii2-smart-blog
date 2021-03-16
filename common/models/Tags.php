<?php

namespace plathir\smartblog\common\models;

use plathir\smartblog\common\models\PostsTags;
use Yii;

/**
 * This is the model class for table "smartblog_posts".
 *
 * @property integer $id
 * @property string $name
 * */
class Tags extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%tags}}';
    }

    public function attributeLabels() {
        return [
            'tags' => Yii::t('blog', 'Tags'),
            'name' => Yii::t('blog', 'Tag Name'),
            'postcnt' => Yii::t('blog', 'Posts Count'),
        ];
    }

    public function getPostcnt() {
        $cnt = 0;
        $posts = PostsTags::findAll(['tag_id' => $this->id]);

        foreach ($posts as $post) {
            $cnt = $cnt + 1;
        }

        return $cnt;
    }

}
