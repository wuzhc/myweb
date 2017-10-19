<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017年10月19日
 * Time: 10:31
 */

namespace common\util;

use Yii;

class FileUtil
{
    /**
     * 下载文件到本地
     * @param $url
     * @param string $saveDir
     * @param $filename
     * @param $type
     * @return array
     * @since 2017-10-19
     */
    public static function download2Local($url, $filename = '', $saveDir = '', $type = 1)
    {
        if (empty($url)) {
            return ['file' => '', 'code' => 1, 'msg' => 'Url can not empty'];
        }
        if (empty($saveDir)) {
            $saveDir = Yii::getAlias('@webroot/public/images');
        }
        if (empty($filename)) {
            $urlPath = parse_url($url, PHP_URL_PATH);
            $filename = basename($urlPath);
            if (empty($filename)) {
                return ['file' => '', 'code' => 2, 'msg' => 'Target is not a file url'];
            }
        }
        if ($type == 1) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 1表示返回内容
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_REFERER, 'https://note.youdao.com/editor/collab/bulb.html');
            $res = curl_exec($ch);
            curl_close($ch);
        } else {
            ob_start();
            ob_clean();
            readfile($url);
            $res = ob_get_contents();
            ob_end_clean();
        }

        $localPath = $saveDir . '/' . $filename;
        $fp = fopen($localPath, 'a');
        fwrite($fp, $res);
        fclose($fp);
        return ['file' => $localPath, 'code' => 0, 'msg' => 'success'];
    }

    /**
     * Upload local file to qiniu
     *
     * @param string $path the local path of file
     * @param string $filename
     * @param bool $isDel Whether to delete local file when upload successfully, default to true
     * @return bool
     * @since 2016-12-01
     */
    public static function uploadToQiniu($path, $filename = '', $isDel = true)
    {
        if (!QINIU_ON) {
            YII_DEBUG && print_r('qiniu close');
            return false;
        }

        $qiniu = QiniuUtil::upload($path, $filename);
        if (false !== $qiniu) {
            $isDel && @unlink($path);
            return QINIU_DOMAIN . $qiniu['key'];
        } else {
            return false;
        }
    }
}
