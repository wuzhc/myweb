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
        $file = self::getLocalPath($filename);
        if (!is_file($file)) {
            return 0;
        }
        return filesize($file);
    }

    public static function getLocalPath($file)
    {
        return \Yii::getAlias('@webroot'). $file;
    }

    /**
     * get web url of file
     * @param $file
     * @return string
     */
    public static function getWebUrl($file)
    {
        if (substr($file, 0, 7) == '/uploads') {
            return \Yii::getAlias('@web') . '/' . $file;
        }
        return $file;
    }
}