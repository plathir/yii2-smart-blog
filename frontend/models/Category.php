<?php
namespace plathir\smartblog\frontend\models;

use Yii;
use plathir\cropper\behaviors\UploadImageBehavior;
use yii\behaviors\SluggableBehavior;

/*
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 */

class Category extends \yii\db\ActiveRecord {

    use \plathir\smartblog\frontend\traits\ModuleTrait;

    public static function tableName() {
        return '{{%categories}}';
    }

    function getImageUrl() {
        if ($this->image) {
            return Yii::getAlias($this->module->CategoryImagePathPreview) . '/' . $this->id . '/' . $this->image;
        } else {
            return Yii::getAlias($this->module->CategoryImagePathPreview) . '/nophoto.png';
        }
    }
   
}
