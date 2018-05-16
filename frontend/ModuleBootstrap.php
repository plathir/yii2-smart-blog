<?php

namespace plathir\smartblog\frontend;

use yii\base\BootstrapInterface;
use Yii;

/**
 * Class ModuleBootstrap
 *
 */
class ModuleBootstrap implements BootstrapInterface {

    /**
     * @param \yii\base\Application $oApplication
     */
    public function bootstrap($oApplication) {
        $aModuleList = $oApplication->getModules();

        foreach ($aModuleList as $sKey => $aModule) {
            // custom code for blog url rules
            if (is_array($aModule) && $sKey == 'blog') {
                $sFilePathConfig = Yii::getAlias('@vendor') . DIRECTORY_SEPARATOR . 'plathir' . DIRECTORY_SEPARATOR . 'yii2-smart-blog' . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . '_routes.php';
                if (file_exists($sFilePathConfig)) {
                    $oApplication->getUrlManager()->addRules(require($sFilePathConfig));
                }
            };
        }
    }

}
