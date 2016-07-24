<?php

namespace plathir\smartblog\backend\models;

use yii\db\ActiveRecord;

/**
 * This is your extended tree model.
 *
 * @property string $description
 * @property string $image
 */
class Categorytree extends \kartik\tree\models\Tree {

    use \plathir\smartblog\backend\traits\ModuleTrait;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'categories';
    }

    public function rules() {
        $rules = parent::rules();

        $rules[] = [['description'], 'string'];
        return $rules;
    }

    public function events() {
        return [
            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete'
        ];
    }

    public function behaviors() {

        $new_behavior = parent::behaviors();
        $new_behavior['uploadImageBehavior'] = [
            'class' => 'plathir\cropper\behaviors\UploadImageBehavior',
            'attributes' => [
                'image' => [
                    'path' => $this->module->CategoryImagePath,
                    'temp_path' => $this->module->CategoryImageTempPath,
                    'url' => $this->module->CategoryImagePathPreview,
                    'key_folder' => 'id',
                ],
            ]
        ];
        return $new_behavior;
    }

}
