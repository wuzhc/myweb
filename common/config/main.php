
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
            /*'enablePrettyUrl' => true, //��url��������
            'showScriptName' => false,//����index.php
            'suffix' => '.html',//��׺
            'enableStrictParsing'=>false,//��Ҫ����ַ�ϸ�ƥ�䣬����Ҫ����rules
            'rules' => [
            ]//��ַƥ�����*/
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=blog',
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
