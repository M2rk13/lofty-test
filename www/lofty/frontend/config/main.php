<?php

use common\models\User;
use yii\log\FileTarget;
use yii\rest\UrlRule;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'api' => [
            'class' => 'frontend\modules\api\Module'
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => 'd49ipDXNBI0afLqoza9dkfYng6bPycKB',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser'
            ],
        ],
        'user' => [
            'identityClass' => User::class,
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                '/' => 'site/login',
                'login' => 'site/login',
                'signup' => 'site/signup',
                'logout' => 'site/logout',
                'positions' => 'position/index',
                'position/create' => 'position/create',
                'position/edit/<id:\d+>' => 'position/edit',
                'position/delete/<id:\d+>' => 'position/delete',
                'position/view/<id:\d+>' => 'position/view',
                'employees' => 'employee/index',
                'employee/create' => 'employee/create',
                'employee/edit/<id:\d+>' => 'employee/edit',
                'employee/delete/<id:\d+>' => 'employee/delete',
                'employee/view/<id:\d+>' => 'employee/view',
                ['class' => 'yii\rest\UrlRule', 'controller' => ['api/position' => 'position-api']],
                ['class' => 'yii\rest\UrlRule', 'controller' => ['api/employee' => 'employee-api']],
            ],
        ],
    ],
    'params' => $params,
];
