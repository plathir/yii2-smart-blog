<?php

namespace plathir\smartblog\helpers;

use plathir\smartblog\models\Posts;

class PostHelper {

    public function getLatestPosts($numOfPosts) {
        $posts = Posts::find()
                ->orderBy(['created_at' => SORT_DESC])
                ->limit($numOfPosts)
                ->all();
        if ($posts) {
            return $posts;
        } else {
            return null;
        }
    }

    public function getPostIntroImage($id, $view = null) {
        $post = Posts::find()
                ->where(['id' => $id])
                ->one();
        if ($post) {
            if ($post->intro_image != null) {
                $key = $post->module->KeyFolder;
                $key_folder = $$key;
                return $post->module->ImagePathPreview . '/' . $key_folder . '/' . $post->intro_image;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function getPostFullImage($id, $view = null) {
        $post = Posts::find()
                ->where(['id' => $id])
                ->one();
        if ($post) {
            if ($post->full_image != null) {
                $key = $post->module->KeyFolder;
                $key_folder = $$key;
                return $post->module->ImagePathPreview . '/' . $key_folder . '/' . $post->full_image;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

}
