<?php

namespace plathir\smartblog\backend\models;

use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;

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

    public function behaviors() {
        $behav = parent::behaviors();

        $behav["slagBehavior"] = [
            'class' => SluggableBehavior::className(),
            'attribute' => 'name',
            'slugAttribute' => 'slug',
            'ensureUnique' => true,
        ];

        return $behav;
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
