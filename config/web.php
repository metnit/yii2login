<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'DEMO',
    'name' => 'DEMO',
    'language'=>'th', 
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
/*    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'enableConfirmation' => false,
            'enableRegistration' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            //'admins' => ['admin']
        ],
    ],*/
    'components' => [
 /*     'view' => [
             'theme' => [
                 'pathMap' => [
                    '@app/views' => '@app/themes/adminlte'
                 ],
             ],
        ],*/
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'nnVaBr3N-HIKxaYRjAWVzc0QnP6cmMU7',
             'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
           // 'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                   'content/<id:\d+>' => 'site/content',
                   'home'=>'site/index',
                   '<controller:\w+>/<id:\d+>' => '<controller>/view',
                   '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                   '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                  /*  array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
                    array('api/view', 'pattern'=>'api/<model:\w+>/<id:[\w-]+>/<value:[\w-]+>', 'verb'=>'GET'),
                    array('api/update', 'pattern'=>'api/<model:\w+>/<id:[\w-]+>', 'verb'=>'POST'),
                    array('api/delete', 'pattern'=>'api/<model:\w+>/<id:[\w-]+>', 'verb'=>'DELETE'),
                    array('api/create', 'pattern'=>'api/<model:\w+>', 'verb'=>'POST'),*/
                   ['class' => 'yii\rest\UrlRule', 'controller' => 'location', 'except' => ['delete','GET', 'HEAD','POST','OPTIONS'], 'pluralize'=>false],
                   '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ],
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
