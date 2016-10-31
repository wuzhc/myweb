<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2016/8/29
 * Time: 9:16
 */

namespace common\util;


use yii\helpers\StringHelper;

class StringUtil
{
    /**
     * @brief 转换编码
     * @param string $in 原有编码
     * @param string $out 转换后编码
     * @param array|string $data 支持多维数组
     * @return array|string
     * @since 2016-08-29
     */
    public static function transCoding($data, $in = 'GBK', $out = 'UTF-8')
    {
        if (is_string($data)) {
            return iconv($in, $out, $data);
        }
        if (is_array($data)) {
            return array_map(function($val) {
                return self::transCoding($val);
            }, $data);
        }
        return $data;
    }

    /**
     * 唯一字符串
     * @return string
     * @since 2016-09-27
     */
    public static function uniqueStr()
    {
        return md5(uniqid(md5(microtime(true)),true)).rand(1000,9999);
    }

}