<?php
namespace plathir\smartblog\migrations;

use yii\db\Migration;

class BlogModuleMigration extends Migration {

    public function up() {

        $this->CreateModuleTables();


//        $this->CreateModuleWidgetTypes();
//
//        $this->CreateModulePositions();
//
//        $this->CreateModuleWidgets();
//
//        $this->CreateModuleMenu();        
    }

    public function down() {
        $this->dropIfExist('categories');
        $this->dropIfExist('posts');
        $this->dropIfExist('posts_tags');
        $this->dropIfExist('posts_rating');
        $this->dropIfExist('tags');
        $this->dropIfExist('static_pages');
        $this->dropIfExist('static_pages_lang');
    }

    public function CreateModuleTables() {

        $this->dropIfExist('categories');
        $this->dropIfExist('posts');
        $this->dropIfExist('posts_tags');
        $this->dropIfExist('posts_rating');
        $this->dropIfExist('tags');
        $this->dropIfExist('static_pages');
        $this->dropIfExist('static_pages_lang');

        // Categories 

        $this->createTable('catergories', [
            'id' => $this->bigPrimaryKey(),
            'root' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'lvl' => $this->smallInteger(5)->notNull(),
            'name' => $this->string(60)->notNull(),
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
            'removable_all' => $this->boolean()->notNull()->defaultValue(false)
        ]);

        $this->createIndex('blog_tree_NK1', 'categories', 'root');
        $this->createIndex('blog_tree_NK2', 'categories', 'lft');
        $this->createIndex('blog_tree_NK3', 'categories', 'rgt');
        $this->createIndex('blog_tree_NK4', 'categories', 'lvl');
        $this->createIndex('blog_tree_NK5', 'categories', 'active');

        $this->createTable('posts', [
            'id' => $this->bigPrimaryKey(),
            'slug' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'intro_text' => $this->text()->notNull(),
            'full_text' => $this->text()->notNull(),
            'image' => $this->string()->notNull(),
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
        ]);

        $this->createTable('posts_tags', [
            'post_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);

        $this->addPrimaryKey('posts_tags_pk', 'posts_tags', ['post_id', 'tag_id']);
        $this->addForeignKey('fk_posts_tags', 'posts_tags', 'post_id', 'posts', 'id', 'CASCADE', 'CASCADE');


        $this->createTable('posts_rating', [
            'post_id' => $this->bigPrimaryKey(),
            'rating_sum' => $this->integer(),
            'rating_count' => $this->integer(),
            'last_ip' => $this->string(20),
        ]);


        $this->createTable('tags', [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string(255),
            'posts_cnt' => $this->integer,
        ]);


        $this->createTable('static_pages', [
            'id' => $this->bigPrimaryKey(),
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
        ]);

        $this->createTable('static_pages_lang', [
            'id' => $this->bigPrimaryKey(),
            'lang' => $this->string(2)->notNull(),
            'description' => $this->string(255)->notNull(),
            'intro_text' => $this->text()->notNull(),
            'full_text' => $this->text()->notNull(),
        ]);
        $this->addPrimaryKey('pk_static_pages_lang', 'static_pages_lang', ['id', 'lang']);
        $this->addForeignKey('fk_static_pages_lang', 'static_pages_lang', 'id', 'static_pages', 'id', 'CASCADE', 'CASCADE');
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
        $this->insert('widgets_positions', [
            'tech_name' => 'be_recipes_dashboard',
            'name' => 'Backend Recipes DashBoard',
            'publish' => '1',
            'module_name' => 'backend-recipes',
        ]);
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
