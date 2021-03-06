<?php

use api\modules\v1\Module;
use yii\log\FileTarget;
use yii\web\JsonParser;
use yii\web\MultipartFormDataParser;
use yii\web\Response;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'on beforeRequest' => function ($event) use ($params) {
            $response = Yii::$app->response;

            $response->headers->add('Access-Control-Allow-Origin', '*');
            $response->headers->add('Access-Control-Allow-Methods', '*');
            $response->headers->add('Access-Control-Allow-Headers', '*');
            $response->headers->add('Access-Control-Expose-Headers', '*');

            if (Yii::$app->request->isOptions) {
                $response->statusCode = 200;
                $response->send();
            }
        }
    ],
    'modules' => [
        'v1' => [
            'class' => Module::class,
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'request' => [
            'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => JsonParser::class,
                'multipart/form-data' => MultipartFormDataParser::class
            ],
        ],
        'response' => [
            'formatters' => [
                Response::FORMAT_JSON => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
            'class' => Response::class,
            'format' => 'json',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => require __DIR__ . '/rules.php',
        ]
    ],
    'params' => $params,
];
