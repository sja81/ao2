<?php
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
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl'   => '/'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true, 'path' => '/'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            //'urlFormat'=>'path',
            'baseUrl'   => '/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => array(
		'test-mail' => 'test-mail/index',	
                'students' => 'students/index',
                'students/<action:[a-zA-Z0-9-]+>' => 'students/<action>',
                'students/<action:[a-zA-Z0-9-]+>/<id:\d+>' => 'students/<action>',
                'applicant' => 'applicant/index',
                'applicant/<action:[a-zA-Z0-9-]+>' => 'applicant/<action>',
                'app-request-eng' => 'app-request-eng/index',
                'financny-dotaznik' => 'app-request/index',
                'app-request' => 'app-request/index',
                'app-request/<action:[a-zA-Z0-9-]+>' => 'app-request/<action>',
                'financny-dotaznik' => 'app-request/index',
                'financny-dotaznik/<action:[a-zA-Z0-9-]+>' => 'app-request/<action>',
                'client'    => 'client/index',
                'login' => 'site/login',
                'partner-login' => 'site/partner-login',
                //'pattern1'=>array('route1', 'urlSuffix'=>'.html', 'caseSensitive'=>false)
                '<action:(error|captcha)>' => 'site/<action>',
                //'nehnutelnost/<slug:[a-zA-Z0-9-]+>/'        => 'site/page',
                //'/' => 'site/index',
                '<view:(.*)>/<id:\d+>-<rewrite_url:[a-zA-Z0-9-]+>.html' => 'site/page',
                '<view:(.*)>' => 'site/page',
                //'<view:[a-zA-Z0-9-]+>/'                     => 'site/page',
                '<controller:\w+>/<id:\d+>'                 => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'    => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>'             => '<controller>/<action>',
            ),
            'scriptUrl' => '/index.php',
        ],
        /*'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=mariadb101.websupport.sk;port=3312;dbname=aoreal_test1',
            'username' => 'aoreal_test1',
            'password' => 'Pb9wf)]XPV',
            'charset' => 'utf8',
        ],*/
    ],
    'params' => $params,
];
