<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017年10月19日
 * Time: 11:38
 */

namespace frontend\controllers;


use common\models\Content;
use common\service\ContentService;
use common\util\FileUtil;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('handle_article_image', false, false, false, false);
        $msg = new AMQPMessage(371);
        $channel->basic_publish($msg, '', 'handle_article_image');
        $channel->close();
        $connection->close();
    }

    public function downloadUrl($url = '', $contentID)
    {
        $url = 'http://note.youdao.com/yws/res/6748/WEBRESOURCE5806ae4e51bb704eac0006e5c3b86af5';
        $path = parse_url($url, PHP_URL_PATH);
        $host = parse_url($url, PHP_URL_HOST);
        $arr = explode('/', $path);
        $len = count($arr);
        $fileID = $arr[$len - 1];
        $number = $arr[$len - 2];
        $share_id = Content::findOne($contentID)->share_id;
        return $host . '/yws/public/resource' . $share_id . '/xmlnote/' . $fileID . '/' . $number;
    }

    public function actionQ()
    {
        $path = 'E:/wamp/www/openSource/myweb/public/images/59e84c5798f1a.png';
        $file = FileUtil::uploadToQiniu($path, uniqid() . '.png', false);
        var_dump($file);
    }
}