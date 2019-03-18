<?php

namespace plathir\smartblog\frontend\models;

use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use Yii;    

/**
 * This is your extended tree model.
 *
 * @property string $description
 * @property string $image
 */
class Categorytree extends \kartik\tree\models\Tree {

    use \plathir\smartblog\frontend\traits\ModuleTrait;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%categories}}';
    }

    public function getPath() {
        $parents = $this->parents()->all();
        $path = '';
        foreach ($parents as $parent) {
            $path[] = $parent->slug;
        }
        $path[] = $this->slug;

        if ($path) {
            return implode('/', $path);
        } else
            return '';
    }

//    function getImageUrl() {
//        if ($this->image) {
//            return Yii::getAlias($this->module->CategoryImagePathPreview) . '/' . $this->id . '/' . $this->image;
//        } else {
//            return Yii::getAlias($this->module->CategoryImagePathPreview) . '/nophoto.png';
//        }
//    }

    
        function getImageUrl() {
        if ($this->image) {
            return Yii::getAlias($this->module->CategoryImagePathPreview) . '/' . $this->id . '/' . $this->image;
        } else {
            return $this->module->assetBundle->baseUrl . '/img/nophoto.png';
            //return Yii::getAlias($this->module->CategoryImagePathPreview) . '/nophoto.png';
        }
    }

    function getImageUrlThumb() {
        if ($this->post_image) {
            return Yii::getAlias($this->module->CategoryImagePathPreview) . '/' . $this->id . '/thumbs/' . $this->image;
        } else {
            return $this->module->assetBundle->baseUrl . '/img/nophoto_thumb.png';
        }
    }
    
    function getChildrens() {
        $childs = $this->children()->all();
        return $childs;
    }
}
