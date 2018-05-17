<?php

namespace plathir\smartblog\frontend;

return [
    '<module>/posts/<id:\d+>-<slug>' => '<module>/posts/view',
    '<module>/posts/<id:\d+>' => '<module>/posts/view',
    '<module>/posts/update/<id:\d+>-<slug>' => '<module>/posts/update',
    '<module>/posts/update/<id:\d+>' => '<module>/posts/update',
    '<module>/category/<id:\d+>' => '<module>/posts/category',
];
