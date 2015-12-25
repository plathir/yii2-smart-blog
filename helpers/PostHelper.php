<?php

namespace plathir\smartblog\helpers;

use plathir\smartblog\models\Posts;

class PostHelper {

    public function getLatestPosts($numOfPosts) {
        $posts = Posts::find()
                ->orderBy(['date_created' => SORT_DESC])
                ->limit($numOfPosts)
                ->all();
        if ($posts) {
            return $posts;
        } else {
            return null;
        }
    }

}
