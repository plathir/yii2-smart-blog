<?php

namespace plathir\smartblog\common\models;

use Yii;

/**
 * This is the model class for table "smartblog_posts".
 *
 * @property integer $id
 * @property integer $lang
 * @property string $description
 * @property string $intro_text
 * @property string $full_text
 */
class PostsLang extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%posts_lang}}';
    }

    
    public function rules() {
        return [
            [['description', 'intro_text', 'full_text' ], 'required'],
            [['intro_text', 'full_text'], 'string'],            
            [['full_text'], 'string'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'description' => Yii::t('blog', 'Description'),
            'slug' => Yii::t('blog', 'Slug'),
            'intro_text' => Yii::t('blog', 'Intro Text'),
            'full_text' => Yii::t('blog', 'Full Text'),
        ];
    }

}
