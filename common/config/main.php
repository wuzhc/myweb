<?php
return [
    'language' => 'zh-CN',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Asia/Shanghai',
    'defaultRoute' => 'article',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'TRvyZcHFusQV31-jHjz2BbWxTD8QryuU',
        ],
        'urlManager' => [
            /*'enablePrettyUrl' => true, //对url进行美化
            'showScriptName' => false,//隐藏index.php
            'suffix' => '.html',//后缀
            'enableStrictParsing'=>false,//不要求网址严格匹配，则不需要输入rules
            'rules' => [
            ]//网址匹配规则*/
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=myweb',
            'username' => 'root',
            'password' => 'wuzhc2580',
            'charset' => 'utf8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'common*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'common' => 'common.php',
                        'common/models/Article' => 'article.php',
                        'common/models/categories' => 'categories.php',
                    ],
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages',
                    'fileMap' => [
                        'backend' => 'backend.php',
                        'backend/views/article/_form' => 'article.php',
                        'backend/categories' => 'categories.php',
                    ],
                ],
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages',
                    'fileMap' => [
                        'frontend' => 'frontend.php',
                        'frontend/article' => 'article.php',
                        'frontend/categories' => 'categories.php',
                    ],
                ],
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ],
            ],
        ],
    ],
];
