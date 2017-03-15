<?php

namespace plathir\smartblog\common\widgets;

use yii\base\Widget;
use plathir\smartblog\common\models\StaticPages;

class StaticPagesWidget extends Widget {

    public $page_id;
    public $displayTitle = false;
    public $displayIntroText = false;
    public $title = '';
    public $selection_parameters = [];

    public function init() {
        parent::init();
        $this->selection_parameters = [
          'page_id' => '',
          'displayTitle' => $this->displayTitle,
          'displayIntroText' => $this->displayIntroText,
          'title' => $this->title,
        ];
    }

    public function run() {
        $this->registerClientAssets();
        $page = $this->findModel($this->page_id);
        if ($page->publish) {
            return $this->render('static_pages_widget', [
                        'widget' => $this,
                        'model' => $page
            ]);
        }
    }

    public function registerClientAssets() {
        $view = $this->getView();
        $assets = Asset::register($view);
    }

    protected function findModel($id) {
        if (($model = StaticPages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
