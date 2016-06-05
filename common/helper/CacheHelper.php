<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/5
 * Time: 13:28
 */

namespace common\helper;

use Yii;

class CacheHelper
{
    /**
     * get Cache
     * @param $key
     * @param int $duration default to one month
     * @param $callBack
     * @return callable|mixed|null
     */
    public static function getCache($key, $callBack, $duration = 2592000)
    {
        $cache = Yii::$app->cache;
        if ($cache->exists($key)) {
            return $cache->get($key);
        }

        if ($callBack) {
            if (is_callable($callBack)) {
                $data = $callBack();
                $cache->set($key, $data, $duration);
                return $data;
            }
        }

        return null;
    }

}