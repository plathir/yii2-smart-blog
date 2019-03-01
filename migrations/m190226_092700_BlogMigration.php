<?php

use yii\db\Migration;
use yii\db\Schema;

class m190226_092700_BlogMigration extends Migration {

    public function up() {

        $this->CreateCategoriesTable();
        $this->CreatePostsTable();
        $this->CreateTagsTable();
        $this->CreatePostsTagsTable();
        $this->CreatePostsRatingTable();
        $this->CreateStaticPagesTable();
        $this->CreateStaticPagesLangTable();
        $this->CreatePostsLangTable();
        $this->CreateCarouselTable();
        $this->CreateCarouselItemsTable();
    }

    public function down() {

        $this->dropIfExist('carousel_items');
        $this->dropIfExist('carousel');
        $this->dropIfExist('posts_lang');
        $this->dropIfExist('static_pages_lang');
        $this->dropIfExist('static_pages');
        $this->dropIfExist('posts_tags');
        $this->dropIfExist('posts_rating');
        $this->dropIfExist('tags');
        $this->dropIfExist('posts');
        $this->dropIfExist('categories');
    }

    public function CreateCategoriesTable() {
        $this->dropIfExist('categories');

        // Categories 

        $this->createTable('categories', [
            'id' => $this->bigPrimaryKey(),
            'root' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'lvl' => $this->smallInteger(5)->notNull(),
            'name' => $this->string(60)->notNull(),
            'slug' => $this->string(100)->notNull(),
            'description' => Schema::TYPE_TEXT,
            'image' => $this->string(255),
            'icon' => $this->string(255),
            'icon_type' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'active' => $this->boolean()->notNull()->defaultValue(true),
            'selected' => $this->boolean()->notNull()->defaultValue(false),
            'disabled' => $this->boolean()->notNull()->defaultValue(false),
            'readonly' => $this->boolean()->notNull()->defaultValue(false),
            'visible' => $this->boolean()->notNull()->defaultValue(true),
            'collapsed' => $this->boolean()->notNull()->defaultValue(false),
            'movable_u' => $this->boolean()->notNull()->defaultValue(true),
            'movable_d' => $this->boolean()->notNull()->defaultValue(true),
            'movable_l' => $this->boolean()->notNull()->defaultValue(true),
            'movable_r' => $this->boolean()->notNull()->defaultValue(true),
            'removable' => $this->boolean()->notNull()->defaultValue(true),
            'removable_all' => $this->boolean()->notNull()->defaultValue(false),
            'child_allowed' => $this->integer(6)->notNull()->defaultValue(0)
                ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createIndex('blog_tree_NK1', 'categories', 'root');
        $this->createIndex('blog_tree_NK2', 'categories', 'lft');
        $this->createIndex('blog_tree_NK3', 'categories', 'rgt');
        $this->createIndex('blog_tree_NK4', 'categories', 'lvl');
        $this->createIndex('blog_tree_NK5', 'categories', 'active');
    }

    public function CreatePostsTable() {
        $this->dropIfExist('posts');

        $this->createTable('posts', [
            'id' => $this->PrimaryKey(),
            'slug' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'intro_text' => $this->text()->notNull(),
            'full_text' => $this->text()->notNull(),
            'post_image' => $this->string()->notNull(),
            'user_created' => $this->integer(11)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'user_last_change' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'publish' => $this->string(1)->notNull(),
            'tags' => $this->text(),
            'category' => $this->integer(),
            'attachments' => $this->text(),
            'gallery' => $this->text(),
            'views' => $this->integer(),
                ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    public function CreateTagsTable() {
        $this->dropIfExist('tags');
        $this->createTable('tags', [
            'id' => $this->PrimaryKey(),
            'name' => $this->string(255),
            'posts_cnt' => $this->integer(),
                ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    public function CreatePostsTagsTable() {
        $this->dropIfExist('posts_tags');

        $this->createTable('posts_tags', [
            'post_id' => $this->integer(11),
            'tag_id' => $this->integer(11),
                ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->addPrimaryKey('pk_posts_tags', 'posts_tags', ['post_id', 'tag_id']);
        $this->addForeignKey('fk_posts_tags', 'posts_tags', 'post_id', 'posts', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_tags', 'posts_tags', 'tag_id', 'tags', 'id', 'CASCADE', 'CASCADE');
    }

    public function CreatePostsRatingTable() {
        $this->dropIfExist('posts_rating');


        $this->createTable('posts_rating', [
            'post_id' => $this->PrimaryKey(),
            'rating_sum' => $this->integer(),
            'rating_count' => $this->integer(),
            'last_ip' => $this->string(20),
                ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
        $this->addForeignKey('fk_posts_rating', 'posts_rating', 'post_id', 'posts', 'id', 'CASCADE', 'CASCADE');
    }

    public function CreateStaticPagesTable() {

        $this->dropIfExist('static_pages');

        $this->createTable('static_pages', [
            'id' => $this->PrimaryKey(),
            'slug' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'intro_text' => $this->text()->notNull(),
            'full_text' => $this->text()->notNull(),
            'user_created' => $this->integer(11)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'user_last_change' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'publish' => $this->string(1)->notNull(),
            'tags' => $this->text(),
                ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createIndex('indx_user_created', 'static_pages', 'user_created');
        $this->createIndex('indx_user_last_change', 'static_pages', 'user_last_change');

        $this->addForeignKey('fk_static_pages_user_cr', 'static_pages', 'user_created', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_static_pages_user_up', 'static_pages', 'user_last_change', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function CreateStaticPagesLangTable() {

        $this->dropIfExist('static_pages_lang');

        $this->createTable('static_pages_lang', [
            'id' => $this->integer(11),
            'lang' => $this->string(2)->notNull(),
            'description' => $this->string(255)->notNull(),
            'intro_text' => $this->text()->notNull(),
            'full_text' => $this->text()->notNull(),
                ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->addPrimaryKey('pk_static_pages_lang', 'static_pages_lang', ['id', 'lang']);
        $this->addForeignKey('fk_st_pages_lang', 'static_pages_lang', 'id', 'static_pages', 'id', 'CASCADE', 'CASCADE');
    }

    public function CreatePostsLangTable() {

        $this->dropIfExist('posts_lang');

        $this->createTable('posts_lang', [
            'id' => $this->integer(11),
            'lang' => $this->string(2)->notNull(),
            'description' => $this->string(255)->notNull(),
            'intro_text' => $this->text()->notNull(),
            'full_text' => $this->text()->notNull(),
                ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->addPrimaryKey('pk_sposts_lang', 'posts_lang', ['id', 'lang']);
        $this->addForeignKey('fk_posts_lang', 'posts_lang', 'id', 'posts', 'id', 'CASCADE', 'CASCADE');
    }

    public function CreateCarouselTable() {
        $this->dropIfExist('carousel');

        $this->createTable('carousel', [
            'id' => $this->PrimaryKey(),
            'title' => $this->string(255),
            'created_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'updated_by' => $this->integer(11),
                ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    public function CreateCarouselItemsTable() {
        $this->dropIfExist('carousel_items');

        $this->createTable('carousel_items', [
            'id' => $this->PrimaryKey(),
            'carousel_id' => $this->integer(11),
            'post_id' => $this->integer(11),
                ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createIndex('indx_carousel_id', 'carousel_items', 'carousel_id');
        $this->createIndex('indx_post_id', 'carousel_items', 'post_id');

        $this->addForeignKey('fk_st_carousel_id', 'carousel_items', 'carousel_id', 'carousel', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_st_post_id', 'carousel_items', 'post_id', 'posts', 'id', 'CASCADE', 'CASCADE');
    }

    public function dropIfExist($tableName) {
        if (in_array($tableName, $this->getDb()->schema->tableNames)) {
            $this->dropTable($tableName);
        }
    }

    public function CreateModuleWidgetTypes() {

//// Latest Posts
//        $this->insert('widgets_types', [
//            'tech_name' => 'be_recipes_latest_recipes',
//            'module_name' => 'backend-recipes',
//            'widget_name' => 'Latest Recipes',
//            'widget_class' => '\apps\recipes\backend\widgets\LatestRecipes',
//            'description' => 'Latest Recipes',
//        ]);
    }

    public function CreateModulePositions() {

        //Positions
//        $this->insert('widgets_positions', [
//            'tech_name' => 'be_recipes_dashboard',
//            'name' => 'Backend Recipes DashBoard',
//            'publish' => '1',
//            'module_name' => 'backend-recipes',
//        ]);
    }

    public Function CreateModuleWidgets() {

// Add to widgets List
//        $this->insert('widgets', [
//            'widget_type' => 'be_recipes_latest_recipes',
//            'name' => 'Latest Recipes',
//            'description' => 'Latest Recipes',
//            'position' => 'be_recipes_dashboard',
//            'config' => '{"latest_num":"3","Theme":"smart"}',
//            'rules' => '',
//            'publish' => 1,
//            'created_at' => new Expression('NOW()'),
//            'updated_at' => new Expression('NOW()'),
//        ]);
//        $id1 = Yii::$app->db->getLastInsertID();
//        
//        
//        // add to position Sort Order
//        $this->insert('widgets_positions_sorder', [
//            'position_tech_name' => 'be_recipes_dashboard',
//            'widget_sort_order' => $id1 . ',' . $id2 . ',' . $id3 . ',' . $id4 . ',' . $id5 . ',' . $id6
//        ]);
    }

    public function CreateModuleMenu() {
        /**
         *  Insert to menu
         */
//        $this->insert('menu', [
//            'name' => 'RecipesMenu',
//            'parent' => NULL,
//            'route' => NULL,
//            'order' => NULL,
//            'data' => NULL,
//            'app' => 'recipes',
//        ]);
//        $key_parent = Yii::$app->db->getLastInsertID();
//
//        $this->insert('apps_menu', [
//            'app_name' => 'recipes',
//            'menu_id' => $key_parent,
//        ]);
    }

}
