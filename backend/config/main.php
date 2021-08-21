<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl'   => '/backoffice',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true, 'path' => '/backoffice'],
            'loginUrl' => ['site/login'],
            'enableSession' => true,
            'authTimeout' => 3600,

        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => [],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'ao-backend',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/backoffice',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            //'urlFormat' => 'path',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'scriptUrl'=>'/backend/index.php',
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
];
