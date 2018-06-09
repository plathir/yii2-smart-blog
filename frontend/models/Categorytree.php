<?php
namespace plathir\smartblog\frontend\models;

use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;

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
        return 'categories';
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

}
