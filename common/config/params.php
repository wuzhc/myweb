<?php
use common\config\Conf;

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,

    'imageCategories' => [
        Conf::GRADUATION_IMG => '毕业相册',
        Conf::TAO_BAO_IMG => '淘宝设计',
        Conf::SHI_NEI_IMG => '室内设计',
        Conf::PING_MIAN_IMG => '平面设计',
    ],

    'baseCats' => [
        Conf::CAT_BACKEND => '后端',
        Conf::CAT_DATABASE => '数据库',
        Conf::CAT_SERVER => '服务器',
        Conf::CAT_FRONTEND => '前端',
        Conf::CAT_ALGORITHM => '编程之道',
        Conf::CAT_GITHUB => 'GitHub',
    ],
];
