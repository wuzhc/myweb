<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��10��19��
 * Time: 16:12
 */

namespace console\controllers;

use common\service\ContentService;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use yii\console\Controller;

class RabbitmqController extends Controller
{
    /**
     * ��������ͼƬ
     * @since 2017-10-19
     */
    public function actionHandleArticleImage()
    {
        $connection = new AMQPStreamConnection('127.0.0.1', 5672, RABBITMQ_USER, RABBITMQ_PWD);
        $channel = $connection->channel();

        // ����һ�����У�ע��ͷ����Ķ���һ��
        // consumer�������У�ȷ������֮ǰ�����Ѿ�����
        $channel->queue_declare('
        ', false, false, false, false);

        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

        // ��Ϣ�Ǵӷ������첽���͵��ͻ���
        $callback = function ($msg) {
            echo " [x] Received ", $msg->body, "\n";
            if (is_numeric($msg->body)) {
                ContentService::factory()->replaceYoudao2Qiniu($msg->body);
            }
        };
        $channel->basic_consume('handle_article_image', '', false, true, false, false, $callback);

        // ���лص�ʱ�����������ܵ���Ϣʱֻ��ص�
        while (count($channel->callbacks)) {
            $channel->wait();
        }
    }
}