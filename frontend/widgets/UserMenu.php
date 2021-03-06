<?php

namespace plathir\smartblog\frontend\widgets;

use plathir\smartblog\frontend\widgets\BaseWidget;

class UserMenu extends BaseWidget {

    public $latest_num = 10;
    public $Theme = 'smart';
    public $title = 'User Menu';
    public $selection_parameters = [];
    public $typeView = 'media';
    public $html = 'This is a test';

    public function init() {
        parent::init();
        $this->selection_parameters = [
            'latest_num' => 10,
            'Theme' => 'smart',
            'typeView' => 'media'
        ];
    }

    public function run() {
        $this->registerClientAssets();
        $this->registerTranslations();
        $helper = new \plathir\smartblog\frontend\helpers\PostHelper();
        $posts = $helper->getLatestPosts($this->latest_num);

        return $this->render('user_menu_widget', [
                    'posts' => $posts,
                    'widget' => $this
        ]);
    }
}
