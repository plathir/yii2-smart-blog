<?php
return [
    '<module>/posts/<path:.*>/<id:\d+>-<slug>' => '<module>/posts/view',
    '<module>/posts/<path:.*>/<id:\d+>-<slug>/update' => '<module>/posts/update',
    '<module>/posts/author/<userid:\d+>-<username>' => '<module>/posts/userposts',
    '<module>/category/<id:\d+>-<slug>' => '<module>/posts/category',
];
