<?php

/** ÊÇ·ñ¿ªÆôÆßÅ£ */
define('QINIU_ON', true);
define('QINIU_BUCKET', 'dasai');
define('QINIU_DOMAIN', 'http://ooy4hh0wt.bkt.clouddn.com/');
define('QINIU_ACCESS_KEY', '_Tppfl9BMWS-Ho9zwOwe_e8UZX7WUSxtJA4fewkx1');
define('QINIU_SECRET_KEY', 'VLzID9xmrZhD8JJb9_CphFu5mVHWIeY314cB_4V81');

return [
    'language' => 'zh-CN',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Asia/Shanghai',
    'defaultRoute' => 'article',
    'components' => [
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
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
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
