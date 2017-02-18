<?php

return [
    'sourcePath' => __DIR__ . DIRECTORY_SEPARATOR . '..',
    'languages' => ['en'],
    'translator' => 'Yii::t',
    'sort' => false,
    'removeUnused' => false,
    'only' => ['*.php'],
    'except' => [
        '.svn',
        '.git',
        '.gitignore',
        '.gitkeep',
        '.hgignore',
        '.hgkeep',
        '/messages',
    ],
    'format' => 'php',
    'messagePath' => __DIR__,
    'overwrite' => true,
];
