<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/29
 * Time: 19:39
 */

namespace common\helper;


class DebugHelper
{
    public static function dump($data, $isExit = true)
    {
        echo '<pre>';
        print_r($data);

        if ($isExit) {
            exit;
        }
    }
}