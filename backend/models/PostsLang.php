<?php

namespace plathir\smartblog\backend\models;


class PostsLang extends \plathir\smartblog\common\models\PostsLang {

    use \plathir\smartblog\backend\traits\ModuleTrait;
    

    public function getRoute() {    
        return ['posts/view', 'id' => $this->id, 'slug' => $this->slug];
    }

    public function getUrl() {
        return \yii\helpers\Url::to($this->getRoute());
    }

}
