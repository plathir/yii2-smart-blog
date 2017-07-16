<?php

namespace plathir\smartblog\migrations;

use yii\db\Migration;

class BlogModuleMigration extends Migration {

    public function up() {

        $this->CreateModuleTables();
    }

    public function down() {
        $this->dropIfExist('categories');
        $this->dropIfExist('posts');
        $this->dropIfExist('posts_tags');
        $this->dropIfExist('posts_rating');
        $this->dropIfExist('tags');
        $this->dropIfExist('static_pages');
    }

    public function CreateModuleTables() {

        $this->dropIfExist('categories');
        $this->dropIfExist('posts');
        $this->dropIfExist('posts_tags');
        $this->dropIfExist('posts_rating');
        $this->dropIfExist('tags');
        $this->dropIfExist('static_pages');

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
            'intro_image' => $this->string()->notNull(),
            'intro_image' => $this->string()->notNull(),
            'full_image' => $this->string()->notNull(),
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

        $this->addPrimaryKey('posts_tags_pk', 'posts_tags_tags', ['post_id', 'tag_id']);
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
    }

    public function dropIfExist($tableName) {
        if (in_array($tableName, $this->getDb()->schema->tableNames)) {
            $this->dropTable($tableName);
        }
    }

}
