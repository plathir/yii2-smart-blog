<?php
namespace plathir\smartblog\frontend;
return [
    '<module>/posts/<path>-<slug>' => '<module>/posts/view',
    '<module>/posts/<path>/<id:\d+>' => '<module>/posts/view',
    '<module>/posts/update/<path>/<id:\d+>-<slug>' => '<module>/posts/update',
    '<module>/posts/update/<path>/<id:\d+>' => '<module>/posts/update',
    '<module>/posts/author/<userid:\d+>-<username>' => '<module>/posts/userposts',
    '<module>/category/<id:\d+>-<slug>' => '<module>/posts/category',
    
];
