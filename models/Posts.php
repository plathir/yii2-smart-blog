<?php

namespace plathir\smartblog\models;

use plathir\cropper\behaviors\UploadImageBehavior;
use plathir\smartblog\traits\ModuleTrait;
use Yii;

/**
 * This is the model class for table "smartblog_posts".
 *
 * @property integer $id
 * @property string $description
 * @property string $intro_text
 * @property string $full_text
 * @property string $intro_image
 * @property string $full_image
 * @property integer $user_created
 * @property string $date_created
 * @property integer $user_last_change
 * @property string $date_last_change
 * @property integer $publish
 * @property string $categories
 */
class Posts extends \yii\db\ActiveRecord {

    use ModuleTrait;

    public $intro_image_file;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'posts';
    }

    public function behaviors() {
        return [
            'uploadImageBehavior' => [
                'class' => UploadImageBehavior::className(),
                'attributes' => [
                    'intro_image' => [
                        'path' => $this->module->ImagePath,
                        'temp_path' => $this->module->ImageTempPath,
                        'url' => $this->module->ImagePathPreview,
                        'key_folder' => 'id',
                    ],
                    'full_image' => [
                        'path' => $this->module->ImagePath,
                        'temp_path' => $this->module->ImageTempPath,
                        'url' => $this->module->ImagePathPreview,
                        'key_folder' => 'id',
                    ]
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['description', 'intro_text', 'full_text', 'user_created', 'date_created'], 'required'],
            [['intro_text', 'full_text'], 'string'],
            [['intro_image', 'full_image'], 'string'],
            [['user_created', 'user_last_change', 'publish'], 'integer'],
            [['date_created', 'date_last_change'], 'safe'],
            [['description', 'categories'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'description' => Yii::t('app', 'Description'),
            'intro_text' => Yii::t('app', 'Intro Text'),
            'full_text' => Yii::t('app', 'Full Text'),
            'intro_image' => Yii::t('app', 'Intro Image'),
            'full_image' => Yii::t('app', 'Full Image'),
            'user_created' => Yii::t('app', 'User Created'),
            'date_created' => Yii::t('app', 'Date Created'),
            'user_last_change' => Yii::t('app', 'User Last Change'),
            'date_last_change' => Yii::t('app', 'Date Last Change'),
            'publish' => Yii::t('app', 'Publish'),
            'categories' => Yii::t('app', 'Categories'),
        ];
    }

}
