<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace plathir\smartblog\backend\models;

use yii\helpers\Url;
/**
 * Description of PostsSearch
 *
 * @author iq10255
 */
use vintage\search\interfaces\SearchInterface;
use yii\db\ActiveRecord;

class PostsGlobalSearch extends \plathir\smartblog\backend\models\PostsLang implements SearchInterface {

    /**
     * @inheritdoc
     */
    public function getSearchTitle() {
        return $this->description;
    }

    /**
     * @inheritdoc
     */
    public function getSearchDescription() {
        return $this->intro_text;
    }

    /**
     * @inheritdoc
     */
    public function getSearchUrl() {
        return Url::toRoute(['blog/posts/view', 'id' => $this->id]);
    }

    /**
     * @inheritdoc
     */
    public function getSearchFields() {
        return [
            'description',
            'intro_text',
            'full_text'
        ];
    }

    public function getFilter() {
   //     return '';
      //  return ['and', ['publish' => true]];
        return ['or', ['intro_text' => '']];
    }

    public function getModuleName() {
        return 'Posts';
    }

}
