<?php

namespace frontend\controllers;

use common\config\Conf;
use common\helper\DebugHelper;
use common\models\Content;
use common\service\CategoryService;
use common\service\ContentService;
use Yii;
use yii\web\Controller;

class ArticleController extends Controller
{
    public function init()
    {
        $this->layout = 'main_cus';
    }

    /**
     * article index page
     * @return string
     */
    public function actionIndex()
    {
        $id = (int)Yii::$app->request->get('id', 203);
        $children = CategoryService::factory()->getChildCategories($id);
        $ids = array_keys($children);
        if ($ids) {
            array_unshift($ids, $id);
        } else {
            $ids = $id;
        }

        $dataProvider = ContentService::factory()->getContents([
            'status' => Conf::ENABLE,
            'categoryID' => $ids,
            'order' => 'sort DESC,create_at DESC',
        ],6);

        return $this->render('index',[
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * article detail view paper
     * @return string
     */
    public function actionView()
    {
        $contentID = (int)Yii::$app->request->get('id');
        if (empty($contentID)) {
            throw new \InvalidArgumentException('illegal argument');
        }

        Content::updateAllCounters(['hits' => 1],['id'=>$contentID]);
        $content = ContentService::factory()->getContent(['id' => $contentID]);
        return $this->render('view', [
            'content' => $content
        ]);
    }


}
