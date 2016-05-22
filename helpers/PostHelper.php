<?php

namespace plathir\smartblog\helpers;

use plathir\smartblog\backend\models\Posts;

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
/**
 * Get list of posts by tags separated by comma 
 * @param type $tag (e.g : tag1,tag2,tag3 )
 * @return type
 */
    public function getPostsbyTags($tag) {
        $tagsArray = explode(",", $tag);
        $posts = [];
        $listPostsIDs = [];
        foreach ($tagsArray as $tagItem) {
            $newPosts = $this->getPostsbyTag($tagItem);
            foreach ($newPosts as $post) {
                if (!empty($posts)) {
                    if (array_search($post->id, $listPostsIDs) === false) {
                        $listPostsIDs[] = $post->id;
                        $posts[] = $post;
                    }
                } else {
                    $listPostsIDs[] = $post->id;
                    $posts[] = $post;
                }
            }
        }
        return $posts;
    }
/**
 * Get Posts by one tag 
 * @param type $tag (e.g : tag1 )
 * @return type
 */
    public function getPostsbyTag($tag) {
        return Posts::find()->where('FIND_IN_SET(:tag, tags)', [':tag' => $tag])->all();
    }

    /**
     * Find similar Posts by tags
     * @param type $id
     */
    public function findSimilarPosts($id) {
        $model = Posts::findOne($id);
        $posts = $this->getPostsbyTags($model->tags);
        $newPosts = [];
        foreach ($posts as $key => $post) {
            if ($post->id != $id) {
                $newPosts[]= $post;
            }
        }
        return $newPosts;
    }   
}
