<?php

namespace plathir\smartblog\common\models;

use Yii;

/**
 * This is the model class for table "smartblog_posts".
 *
 * @property integer $id
 * @property string $description
 * @property string $slug
 * @property string $intro_text
 * @property string $full_text
 * @property integer $user_created
 * @property string $created_at
 * @property integer $user_last_change
 * @property string $updated_at
 * @property integer $publish
 */
class StaticPages extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%static_pages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['description', 'intro_text', 'full_text', 'user_created' ], 'required'],
            [['intro_text', 'full_text'], 'string'],
            [['full_text'], 'string'],
            [['full_text'], 'string'],
            [['full_text'], 'string'],
            [['user_created', 'user_last_change', 'publish', 'code_editor'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('blog', 'ID'),
            'description' => Yii::t('blog', 'Description'),
            'slug' => Yii::t('blog', 'Slug'),
            'intro_text' => Yii::t('blog', 'Intro Text'),
            'full_text' => Yii::t('blog', 'Full Text'),
            'user_created' => Yii::t('blog', 'User Created'),
            'created_at' => Yii::t('blog', 'Date Created'),
            'user_last_change' => Yii::t('blog', 'User Last Change'),
            'updated_at' => Yii::t('blog', 'Date Last Change'),
            'publish' => Yii::t('blog', 'Publish'),
        ];
    }

}
