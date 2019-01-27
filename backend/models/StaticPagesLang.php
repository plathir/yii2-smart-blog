<?php

namespace plathir\smartblog\backend\models;


class StaticPagesLang extends \plathir\smartblog\common\models\StaticPagesLang {

    use \plathir\smartblog\backend\traits\ModuleTrait;

    
    

    public function getRoute() {    
        return ['static-pages/view', 'id' => $this->id, 'slug' => $this->slug];
    }

    public function getUrl() {
        return \yii\helpers\Url::to($this->getRoute());
    }

}
