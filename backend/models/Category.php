<?php

namespace plathir\smartblog\backend\models;

use Yii;
use plathir\cropper\behaviors\UploadImageBehavior;

/*
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 */

class Category extends \yii\db\ActiveRecord {

    use \plathir\smartblog\backend\traits\ModuleTrait;

    public static function tableName() {
        return '{{%categories}}';
    }

    public function behaviors() {
        return [
            'uploadImageBehavior' => [
                'class' => UploadImageBehavior::className(),
                'attributes' => [
                    'image' => [
                        'path' => $this->module->CategoryImagePath,
                        'temp_path' => $this->module->CategoryImageTempPath,
                        'url' => $this->module->CategoryImagePathPreview,
                        'key_folder' => 'id',
                    ],
                ]
            ],
        ];
    }

    public function rules() {
        //  $rules = parent::rules();

        return [
            [['id'], 'required'],
            [['name'], 'required'],
            [['description'], 'string'],
            [['image'], 'string']
        ];
    }

    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Description'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

}
