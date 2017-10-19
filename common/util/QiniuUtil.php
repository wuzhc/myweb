<?php
/**
 * http://blog.csdn.net/netdxy/article/details/50223555
 */
namespace common\util;

use Yii;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

require(Yii::getAlias("@common").'/components/qiniu/autoload.php');

class QiniuUtil {

    public static $auth;

    /**
     * @return Auth
     */
    public static function auth()
    {
        if (self::$auth) {
            return self::$auth;
        }
        return self::$auth = new Auth(QINIU_ACCESS_KEY, QINIU_SECRET_KEY);
    }

    /**
     * 七牛上传
     * @param string $localFile 本地文件路径
     * @param string $key 上传文件名，如果为空，将以当前本地文件路径做为文件名
     * @param array $callback
     * @return bool
     * @throws \Exception
     * @since 2016-11-29
     */
    public static function upload($localFile, $key = '', $callback = array())
    {
        if (isset($callback['callbackUrl']) && isset($callback['callbackBody'])) {
            $token = self::auth()->uploadToken(QINIU_BUCKET, null, 3600, $callback);
        } else {
            $token = self::auth()->uploadToken(QINIU_BUCKET);
        }

        // 上传到七牛后保存的文件名
        if (!$key) {
            $search = array(Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR , '\\');
            $replace = array('','/');
            $key = str_replace($search,$replace,$localFile);
        }

        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();

        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $key, $localFile);

        if ($err !== null) {
            YII_DEBUG && var_dump($err);
            return false;
        } else {
            return $ret;
        }
    }

    /**
     * 七牛持久化处理
     * @param $localFile
     * @param $fops
     * e.g.
     *
     * 图片缩放
     * $fops ='imageView/2/w/200/h/200';
     *
     * 视频转码
     * $fops ='avthumb/flv/vb/229k/vcodec/libx264/noDomain/1';
     *
     * 图片水印
     * $base64URL = Qiniu\base64_urlSafeEncode('http://developer.qiniu.com/resource/logo-2.jpg');
     * $fops = 'watermark/1/image/'.$base64URL;
     *
     * 视频切片
     * $fops = 'avthumb/m3u8/pattern/'.$savets;
     *
     * 切片与加密参数
     * $fops = 'avthumb/m3u8/vb/640k/hlsKey/MDEyMzQ1Njc4OTEyMzQ1Ng==/hlsKeyUrl/aHR0cDovLzd4bGVrYi5jb20yLnowLmdsYi5xaW5pdWNkbi5jb20vcWluaXV0ZXN0LmtleQ==';
     *
     * 文档转换
     * $fops = 'yifangyun_preview';
     *
     * 视频截图
     * $fops = 'vframe/jpg/offset/1/w/480/h/360/rotate/90';
     *
     * 视频拼接
     * $encodedUrl1 = Qiniu\base64_urlSafeEncode('http://7xl4c9.com1.z0.glb.clouddn.com/pingjie2.flv');
     * $encodedUrl2 = Qiniu\base64_urlSafeEncode('http://7xl4c9.com1.z0.glb.clouddn.com/pingjie3.avi');
     * $fops = 'avconcat/2/format/mp4/'.$encodedUrl1.'/'.$encodedUrl2;
     *
     * 多文件压缩
     * $encodedfile1 = Qiniu\base64_urlSafeEncode('http://7xl4c9.com1.z0.glb.clouddn.com/photo1.jpg');
     * $encodedfile2 = Qiniu\base64_urlSafeEncode('http://7xl4c9.com1.z0.glb.clouddn.com/vedio1.mp4');
     * $encodedfile3 = Qiniu\base64_urlSafeEncode('http://7xl4c9.com1.z0.glb.clouddn.com/audio1.mp3');
     * $fops = 'mkzip/2/url/'.$encodedfile1.'/url/'.$encodedfile2.'/url/'.$encodedfile3;
     *
     * @param string $filename
     * @param string $pipeline 管道
     * @return bool
     * @throws \Exception
     */
    public static function fops($localFile, $fops, $filename = '', $pipeline = '')
    {
        //可以对转码后的文件进行使用saveas参数自定义命名，当然也可以不指定文件会默认命名并保存在当间。
        $filename = $filename ?: StringUtil::uniqueStr();

        $savekey = \Qiniu\base64_urlSafeEncode(QINIU_BUCKET.':'.$filename);
        $fops = $fops.'|saveas/'.$savekey;

        $policy['persistentOps'] = $fops;
        if ($pipeline) {
            $policy['persistentPipeline'] = $pipeline;
        }

        $uptoken = self::auth()->uploadToken(QINIU_BUCKET, null, 3600, $policy);
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($uptoken, null, $localFile);

        if ($err !== null) {
            YII_DEBUG && var_dump($err);
            return false;
        } else {
            return $ret;
        }
    }

}