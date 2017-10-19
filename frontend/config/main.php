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
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'app' => [
            'class' => 'frontend\module\AppModule',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'TRvyZcHFusQV31-jHjz2BbWxTD8QryuU',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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

//        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'suffix' => '.html',
//            'rules' => [
//                'article/index/<parentID:\d+>/<cid:\d+>' => 'article/index',
//                'article/index/<parentID:\d+>' => 'article/index',
//                'article/add-comment/<id:\d+>/<width:\d+>/<height:\d+>' => 'article/add-comment',
//                'article/view/<id:\d+>/<parentID:\d+>' => 'article/view',
//                '<controller:[-\w]+>/<action:[-\w]+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:[-\w]+>/<action:[-\w]+>' => '<controller>/<action>',
//            ],
//        ],

        'assetManager' => [
            'basePath' => '@webroot/frontend/web/assets',
            'baseUrl' => '@web/frontend/web/assets'
        ],
    ],
    'params' => $params,
];
