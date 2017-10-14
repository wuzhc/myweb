<?php

namespace frontend\models;

use common\service\ContentService;
use common\util\ClientUtil;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CommentForm extends Model
{
    public $contentID;
    public $text;
    public $verifyCode;
    public $parentID;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['text','contentID'], 'required'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
            ['parentID', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'text' => '',
            'contentID' => '',
            'verifyCode' => '',
        ];
    }

    /**
     * 添加评论
     * 限制：一天只能评论20次
     * @since 2017-10-13
     */
    public function save()
    {
        $clientIP = ClientUtil::getIp();
        $key = 'comment:' . $clientIP;
        $res = Yii::$app->redis->set($key, 1, 'ex', 864000, 'nx');
        if (null === $res && Yii::$app->redis->incr($key) > 50) {
            return false;
        }

        $data['ip'] = $clientIP;
        $data['text'] = $this->text;
        $data['contentID'] = $this->contentID;
        $data['parentID'] = $this->parentID ?: 0;
        return ContentService::factory()->addComment($data);
    }
}
