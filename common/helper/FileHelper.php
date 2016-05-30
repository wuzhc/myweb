<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/30
 * Time: 22:58
 */

namespace common\helper;

class FileHelper extends \yii\helpers\FileHelper
{
    public static function getExt($filename)
    {
        $file = explode('.', $filename);
        return end($file);
    }

    public static function getSize($filename)
    {
        if (!is_file($filename)) {
            return 0;
        }
        return filesize($filename);
    }
}