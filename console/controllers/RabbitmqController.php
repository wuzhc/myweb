<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017年10月19日
 * Time: 16:12
 */

namespace console\controllers;

use common\service\ContentService;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use yii\console\Controller;

class RabbitmqController extends Controller
{
    /**
     * 处理文章图片
     * @since 2017-10-19
     */
    public function actionHandleArticleImage()
    {
        $connection = new AMQPStreamConnection('127.0.0.1', 5672, RABBITMQ_USER, RABBITMQ_PWD);
        $channel = $connection->channel();

        // 声明一个队列，注意和发布的队列一致
        // consumer声明队列，确保消费之前队列已经存在
        $channel->queue_declare('
        ', false, false, false, false);

        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

        // 消息是从服务器异步发送到客户端
        $callback = function ($msg) {
            echo " [x] Received ", $msg->body, "\n";
            if (is_numeric($msg->body)) {
                ContentService::factory()->replaceYoudao2Qiniu($msg->body);
            }
        };
        $channel->basic_consume('handle_article_image', '', false, true, false, false, $callback);

        // 当有回调时将阻塞，接受到消息时只需回调
        while (count($channel->callbacks)) {
            $channel->wait();
        }
    }
}