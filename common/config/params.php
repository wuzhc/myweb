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
];
