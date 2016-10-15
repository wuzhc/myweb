<?php

namespace common\config;


class Conf
{
    /** 文章模型 */
    const ARTICLE_MODEL = 1;
    /** 相册模型 */
    const ALBUM_MODEL = 2;

    /** 内容可用 */
    const ENABLE = 0;
    /** 内容不可用 */
    const DISABLE = 1;

    const GRADUATION_IMG = 1;
    const SHI_NEI_IMG = 2;
    const PING_MIAN_IMG = 3;
    const TAO_BAO_IMG = 4;

    /** 默认上传目录 */
    const UPLOAD_DEFAULT_DIR = 'uploads';
    const THUMB_DEFAULT = 'public/common/images/thumb_default.jpg';

    /** 数据为空默认图片提示 */
    const EMPTY_DATA = 'public/common/images/none_data.png';

    /** 系统默认第一级分类 */
    const CAT_FRONTEND = 1; //前端分类
    const CAT_BACKEND = 2; //后端分类
    const CAT_DATABASE = 3; //数据库分类
    const CAT_SERVER = 4; //服务器分类
}