<?php

return [
    '<module>/posts/<path:.*>/<id:\d+>-<slug>' => '<module>/posts/view',
    '<module>/posts/<id:\d+>' => '<module>/posts/view',
    '<module>/posts/update/<path:.*><id:\d+>-<slug>' => '<module>/posts/update',
    '<module>/posts/update/<path:.*><id:\d+>' => '<module>/posts/update',
    '<module>/posts/author/<userid:\d+>-<username>' => '<module>/posts/userposts',
    '<module>/category/<id:\d+>-<slug>' => '<module>/posts/category',
//        [
//            'pattern' => '<module>/posts/<path:.*>/<id:\d+>-<slug>',
//            'route' => '<module>/posts/',
//            'encodeParams' => false,
//        ],
];
