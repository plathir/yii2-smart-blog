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
class StaticPagesLang extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%static_pages_lang}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['lang','description', 'intro_text', 'full_text' ], 'required'],
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
            'id' => Yii::t('blog', 'ID'),
            'lang' => Yii::t('blog', 'Language'),
            'description' => Yii::t('blog', 'Description'),
            'intro_text' => Yii::t('blog', 'Intro Text'),
            'full_text' => Yii::t('blog', 'Full Text'),
        ];
    }
}
