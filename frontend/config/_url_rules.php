<?php

return [
    '<module>/posts/<path:.*>/<id:\d+>-<slug>' => '<module>/posts/view',
    '<module>/posts/<path:.*>/<id:\d+>-<slug>/update' => '<module>/posts/update',
    '<module>/posts/author/<userid:\d+>/<username>' => '<module>/posts/userposts',
    '<module>/category/<id>/<slug:.*>' => '<module>/posts/category',
    '<module>/categoryall/<id>/<slug:.*>' => '<module>/posts/categoryall',
//    '<module>/category/<slug:.*>' => '<module>/posts/category',
//    '<module>/categoryall/<slug:.*>' => '<module>/posts/categoryall',
    
    '<module>/posts/tags/<tag>' => '<module>/posts/tags',
];
