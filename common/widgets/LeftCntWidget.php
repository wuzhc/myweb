<?php
/**
 * ǰ�������ݣ������Ķ����к����¶�̬��
 * User: Administrator
 * Date: 2016/10/31
 * Time: 8:45
 */

namespace common\widgets;


use common\config\Conf;
use common\service\CategoryService;
use common\service\ContentService;
use yii\base\Widget;

class LeftCntWidget extends Widget
{
    public function run()
    {
        $categories = CategoryService::factory()->getCategories([
            'status' => Conf::ENABLE,
            'level' => 2,
        ]);

        $rank = ContentService::factory()->findQuery(array(
            'select' => 'id,title,hits',
            'status' => Conf::ENABLE,
            'order' => 'hits Desc',
            'limit' => 10,
        ));

        return $this->render('leftCnt', array(
            'categories' => $categories,
            'rank' => $rank->all()
        ));
    }
}