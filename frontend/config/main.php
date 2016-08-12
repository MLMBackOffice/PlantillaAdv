<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'es',
    'sourceLanguage' =>'en',
    'modules'=>[
        'gridView'=>[
            'class' => '\kartik\grid\Module'
        ],
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            //'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'authTimeout' => 120,
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
        
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'weifastpay@gmail.com',
                'password' => 'Riqueza125336,',
                'port' => '587',
                'encryption' => 'tls',
            ],
            'messageConfig' => [
                'from' => ['weifastpay@gmail.com' => 'Corporativo'], // this is needed for sending emails
                'charset' => 'UTF-8',
            ]
        ],
        
        // antes de i18n 110816
        
//        'i18n' => [
//            'translations' => [
//                'app*' => [
//                    'class' => 'yii\i18n\PhpMessageSource',
//                    //'basePath' => '@app/messages/es/user.php', // example: @app/messages/fr/user.php
//                    //'sourceLanguage' => 'en',
//                    'fileMap' => [
//                        'app' => 'app.php',
//                        'app/error' => 'error.php',
//                    ],
//                ]
//            ],
//        ],
        
//        'urlManager' => [            
//            'showScriptName' => false,
//            'enablePrettyUrl' => true,
//            'rules' => [
//                '' => 'site/index',
//                '<alias:\w+>' => 'site/<alias>',
//                
//            ],
            //array(
//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    //            '<controller:\w+>/<action:\w+>/<patrocinador:\w+>' => '<controller>/<action>/<patrocinador>',
            //),
//        ],
    ],
    'params' => $params,
];
