<?php

namespace common\util;

class ClientUtil 
{
    /**
     * 客户端IP
     * @return string
     */
    public static function getIp()
    {
        $ip = '';
        $xip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        $cip = $_SERVER['HTTP_CLIENT_IP'];
        $rip = $_SERVER['REMOTE_ADDR'];

        //使用代理服务器情况
        if($xip && strcasecmp($xip, 'unknown')) {
            if(false !== strpos($xip,',')) {
                $ipArr = explode(',',$xip);
                foreach($ipArr as $val) {
                    if(trim(strtolower($val)) != 'unknown') {
                        $ip = $val;
                        break;
                    }
                }
            } else {
                $ip = $xip;
            }
        } elseif($cip && strcasecmp($cip, 'unknown')) {
            $ip = $cip;
        } elseif($rip && strcasecmp($rip, 'unknown')) {
            $ip = $rip;
        }

        preg_match("/[\d\.]{7,15}/", $ip, $match);
        return $match[0] ? $match[0] : 'unknown';
    }
}