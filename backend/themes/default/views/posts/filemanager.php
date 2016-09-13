<?php

use mihaildev\elfinder\ElFinder;
?>

    
<div class="container-fluid" style="height:800px">

    <?php
    echo 'File Manager';
    echo ElFinder::widget([
        'language' => 'en',
      'controller' => 'blog/elfinder', // вставляем название контроллера, по умолчанию равен elfinder
        'filter' => 'image', // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
//    'callbackFunction' => new JsExpression('function(file, id){}') // id - id виджета
//    'frameOptions' => [
//                'height' => '400px',
//    ],
        'containerOptions' => [
            'resizable' => 'true',
            'style' => 'height:100%',
        ]
    ]);
    ?>

</div>

