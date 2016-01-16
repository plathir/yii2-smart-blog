<?php

namespace plathir\smartblog\models;

use vova07\fileapi\behaviors\UploadBehavior;
use plathir\smartblog\traits\ModuleTrait;
use Yii;
use karpoff\icrop\CropImageUploadBehavior;

/**
 * This is the model class for table "smartblog_posts".
 *
 * @property integer $id
 * @property string $description
 * @property string $intro_text
 * @property string $full_text
 * @property string $intro_image
 * @property integer $full_image
 * @property integer $user_created
 * @property string $date_created
 * @property integer $user_last_change
 * @property string $date_last_change
 * @property integer $publish
 * @property string $categories
 */
class Posts extends \yii\db\ActiveRecord {

    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'posts';
    }

    public function behaviors() {
        return [
            //     TimestampBehavior::className(),
//            'newBehavior'=>
            [
                'class' => CropImageUploadBehavior::className(),
                'attribute' => 'intro_image',
           //     'scenarios' => ['insert', 'update'],
                'path' => $this->module->ImagePath,
                'url' => $this->module->ImagePathPreview,
                'ratio' => 1,
//                'crop_field' => 'intro_image',
//                'cropped_field' => 'photo_cropped',
            ],
//            'uploadBehavior' => [
//                'class' => UploadBehavior::className(),
//                'attributes' => [
//                    'intro_image' => [
//                        'path' => $this->module->ImagePath,
//                        'tempPath' => $this->module->ImageTempPath,
//                        'url' => $this->module->ImagePathPreview,
//                    ],
//                    'full_image' => [
//                        'path' => $this->module->ImagePath,
//                        'tempPath' => $this->module->ImageTempPath,
//                        'url' => $this->module->ImagePathPreview
//                    ]
//                ]
//            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['description', 'intro_text', 'full_text', 'user_created', 'date_created'], 'required'],
            [['intro_text', 'full_text'], 'string'],
            [['user_created', 'user_last_change', 'publish'], 'integer'],
            [['date_created', 'date_last_change'], 'safe'],
            [['description', 'intro_image', 'categories'], 'string', 'max' => 255]
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
