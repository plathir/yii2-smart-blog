<?php

namespace plathir\smartblog\backend\models;


use Yii;

/**
 * This is the model class for table "{{%rcp_carousel}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property CarouselItems $CarouselItems
 */
class CarouselItems extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%carousel_items}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['post_id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'carousel_id' => Yii::t('app', 'Carousel ID'),
            'post_id' => Yii::t('app', 'Post ID'),
        ];
    }


}
