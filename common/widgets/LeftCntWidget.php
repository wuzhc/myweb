<?php
/**
 * ǰ�������ݣ������Ķ����к����¶�̬��
 * User: Administrator
 * Date: 2016/10/31
 * Time: 8:45
 */

namespace common\widgets;


use common\config\Conf;
use common\service\ContentService;
use yii\base\Widget;

class LeftCntWidget extends Widget
{
    public function run()
    {
        $latest = ContentService::factory()->findQuery(array(
            'select' => 'id,title,create_at',
            'status' => Conf::ENABLE,
            'order' => 'id Desc',
            'limit' => 10,
        ));

        $rank = ContentService::factory()->findQuery(array(
            'select' => 'id,title,hits',
            'status' => Conf::ENABLE,
            'order' => 'hits Desc',
            'limit' => 10,
        ));

        return $this->render('leftCnt', array(
            'latest' => $latest->all(),
            'rank' => $rank->all()
        ));
    }
}