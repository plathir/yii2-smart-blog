<?php

namespace plathir\smartblog\frontend\helper;

use plathir\smartblog\frontend\models\Posts;
use plathir\smartblog\common\models\Tags;
use plathir\smartblog\common\models\PostsTags;

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

    public function getMostVisitedPosts($numOfPosts) {
        $posts = Posts::find()
                ->orderBy(['views' => SORT_DESC])
                ->limit($numOfPosts)
                ->all();
        if ($posts) {
            return $posts;
        } else {
            return null;
        }
    }

    public function getTopRated($numOfPosts) {

        $posts_rating = (new \yii\db\Query())
                ->select(['*, (rating_sum / rating_count) AS rate'])
                ->from('rcp_posts_rating')
                ->orderBy('rate desc')
                ->limit($numOfPosts)
                ->all();

        if ($posts_rating) {
            foreach ($posts_rating as $posts_rating) {
                $posts[] = Posts::findOne(['id' => $posts_rating['post_id']]);
            }
            return $posts;
        } else {
            return null;
        }
    }

    public function getTopAuthors($numOfAuthors) {


        $temp_topAuthors = (new \yii\db\Query())
                ->select(['user_created as author', 'count(*) as cnt'])
                ->from('posts')
                ->groupBy(['user_created'])
                ->limit(10)
                ->all();
        $topAuthors = '';
        foreach ($temp_topAuthors as $Author) {
            $userid = $Author['author'];
            $username = PostHelper::getUserName($userid);
            $topAuthors[] = [
                'userid' => $userid,
                'author' => $username,
                'cnt' => $Author['cnt']
            ];
        }

        //test
        if ($topAuthors) {
            return $topAuthors;
        } else {
            return null;
        }
    }

    //get username
    public function getUserName($user_id) {

        $PostsModel = new Posts();
        $userModel = new $PostsModel->module->userModel();
        return $userModel::findOne(['id' => $user_id])->{$PostsModel->module->userNameField};
    }

    public function getRecipeIntroImage($id, $view = null) {
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

    public function getRecipeFullImage($id, $view = null) {
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
            foreach ($newPosts as $recipe) {
                if (!empty($posts)) {
                    if (array_search($recipe->id, $listPostsIDs) === false) {
                        $listPostsIDs[] = $recipe->id;
                        $posts[] = $recipe;
                    }
                } else {
                    $listPostsIDs[] = $recipe->id;
                    $posts[] = $recipe;
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
        $tag_id = Tags::find()->select(['id'])->where(['name' => $tag])->one();
        $tags = PostsTags::find()->select(['post_id'])->where(['tag_id' => $tag_id->id])->groupBy(['post_id'])->all();
        foreach ($tags as $tag) {
            $tags_array[] = $tag->post_id;
        }
        $posts = Posts::find()->where(['in', 'id', $tags_array])->all();
        return $posts;
    }

    /**
     * Find similar Posts by tags
     * @param type $id
     */
    public function findSimilarPosts($id) {
        $model = Posts::findOne($id);
        $posts = $this->getPostsbyTags($model->tags);
        $newPosts = [];
        foreach ($posts as $key => $recipe) {
            if ($recipe->id != $id) {
                $newPosts[] = $recipe;
            }
        }
        return $newPosts;
    }

}
