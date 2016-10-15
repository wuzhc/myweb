<?php

namespace frontend\module\controllers;

use common\config\Conf;
use common\models\Categories;
use common\models\Content;
use common\service\CategoryService;
use common\service\ContentService;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class DefaultController extends Controller
{
    public $layout = "main";

    public function actionIndex()
    {
        $return = [];
        $baseCatIDs = array_keys(Yii::$app->params['baseCats']);
        if ($baseCatIDs) {
            foreach ($baseCatIDs as $baseCID) {
                $temp = [];
                $cats = CategoryService::factory()->getChildCategories($baseCID);
                if ($cats) {
                    $catIDs = array_keys($cats);
                    $data = ContentService::factory()->getLimitArticle(implode(',',$catIDs), 1);
                    $temp['cats'] = $cats;
                    $temp['articles'] = $this->_packData($data, $catIDs);
                    $return[] = $temp;
                }
            }
        }
        //print_r($return);exit;
        return $this->render('index', ['datas' => $return]);
    }

    /**
     * 列表页
     * @return string
     */
    public function actionList()
    {
        $cid = (int)Yii::$app->request->get('cid');
        $dataProvider = ContentService::factory()->getContents([
            'categoryID' => $cid,
            'status' => Conf::ENABLE
        ],10);

        return $this->render('list', [
            'catName' => Categories::findOne($cid)->title,
            'datas' => $dataProvider->getModels()
        ]);
    }

    /**
     * 内容页
     * @return string
     */
    public function actionDetail()
    {
        $contentID = (int)Yii::$app->request->get('id');
        if (empty($contentID)) {
            throw new \InvalidArgumentException('illegal argument');
        }
        Content::updateAllCounters(['hits' => 1],['id'=>$contentID]);
        return $this->render('detail', [
            'content' => ContentService::factory()->getContent(['id' => $contentID])
        ]);
    }

    /**
     * 包装数据
     * @param $articles
     * @return array
     */
    private function _packData($articles, $catIDs)
    {
        $data = [];
        foreach ($catIDs as $cid) {
            $data[$cid] = [];
        }

        foreach ($articles as $article) {
            $temp['id'] = $article['id'];
            $temp['cid'] = $article['category_id'];
            $temp['title'] = $article['title'];
            $temp['hits'] = $article['hits'];
            $temp['create'] = date('Y-m-d H:i:s', $article['create_at']);
            $data[$article['category_id']][] = $temp;
        }

        return $data;
    }

    /**
     * 获取更多数据
     */
    public function actionGetMore()
    {
        $cid = (int)Yii::$app->request->get('cid');
        $offset = (int)Yii::$app->request->get('offset');
        if (!is_numeric($cid) || !is_numeric($offset)) {
            echo '';
        }

        echo $this->renderPartial('get_more', [
            'datas' =>  ContentService::factory()->findQuery([
                'categoryID' => $cid,
                'offset' => $offset,
                'limit' => 10,
                'status' => Conf::ENABLE,
                'order' => 'create_at DESC'
            ])->all()
        ]);
    }
}
