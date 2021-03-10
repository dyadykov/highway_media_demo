<?php

use yii\rest\UrlRule;

return [
    [
        'class' => UrlRule::class,
        'controller' => ['v1/wonderful-item'],
        'pluralize' => false,
    ],
    '<module>/<controller>/<action>/<id:(\d+)>' => '<module>/<controller>/<action>',
    '<module>/<controller>/<action>' => '<module>/<controller>/<action>',
    '<module>/<controller>' => '<module>/<controller>/index',
];