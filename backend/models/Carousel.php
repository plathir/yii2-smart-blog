<?php

namespace plathir\smartblog\backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use plathir\smartblog\backend\models\CarouselItems;
use plathir\user\common\models\account\User;


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
class Carousel extends \yii\db\ActiveRecord {

    use \plathir\smartblog\backend\traits\ModuleTrait;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%carousel}}';
    }

    public function behaviors() {

        return [
            'timestampBehavior' =>
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => function() {
                    return date('U');
                }
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('blog', 'ID'),
            'title' => Yii::t('blog', 'Title'),
            'created_at' => Yii::t('blog', 'Created At'),
            'created_by' => Yii::t('blog', 'Created By'),
            'updated_at' => Yii::t('blog', 'Updated At'),
            'updated_by' => Yii::t('blog', 'Updated By'),
            'CreatedByName' => Yii::t('blog', 'Created by'),
            'UpdatedByName' => Yii::t('blog', 'Updated by'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarouselItems() {
        return $this->hasMany(CarouselItems::className(), ['carousel_id' => 'id']);
    }

    public function getCreatedByName() {
        return $this->hasOne(User::className(), ['id' => 'created_by'])->select(['username'])->one()->username;
    }

    public function getUpdatedByName() {
        return $this->hasOne(User::className(), ['id' => 'updated_by'])->select(['username'])->one()->username;
    }

}
