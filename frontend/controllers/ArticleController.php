<?php

namespace frontend\controllers;

use common\config\Conf;
use common\helper\DebugHelper;
use common\models\ArticleContent;
use common\models\Categories;
use common\models\Content;
use common\service\CategoryService;
use common\service\ContentService;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use yii\web\Controller;

class ArticleController extends Controller
{
    /**
     * article index page
     * @return string
     */
    public function actionIndex()
    {
        $baseCID = Yii::$app->request->get('parentID',2);
        $cid = Yii::$app->request->get('cid');

        if (!is_numeric($baseCID) || !in_array($baseCID, array_keys(Yii::$app->params['baseCats']))) {
            Yii::$app->end('参数错误！');
        }

        $childrenCats = CategoryService::factory()->getChildCategories($baseCID);

        if ($cid && !in_array($cid, ArrayHelper::getColumn($childrenCats,'id'))) {
            Yii::$app->end('参数错误！');
        }

        $firstCatID = $childrenCats[0]['id'];
        $cid = $cid ?: $firstCatID;

        if (!($cid)) {
            $articles = array();
        } else {
            $articles = ContentService::factory()->getContents(array(
                'status' => Conf::ENABLE,
                'order' => 'sort Desc, id Desc',
                'categoryID' => $cid
            ),10);
        }

        return $this->render('index',array(
            'articles' => $articles,
            'cats' => $childrenCats,
            'parentID' => $baseCID,
            'cid' => $cid
        ));
    }

    /**
     * article detail view paper
     * @return string
     * @since 2016-10-31
     */
    public function actionView()
    {
        $contentID = Yii::$app->request->get('id');
        if (!is_numeric($contentID)) {
            Yii::$app->end('参数错误！');
        }

        $article = ContentService::factory()->getContent(array('id' => $contentID));
        if (!$article) {
            Yii::$app->end('暂无内容！');
        }

        Content::updateAllCounters(['hits' => 1],['id'=>$contentID]);

        return $this->render('view', [
            'content' => $article,
            'category' => Categories::findOne($article->category_id),
            'prev' => ContentService::factory()->getPrevOrNextArticle('prev', $contentID, $article->category_id),
            'next' => ContentService::factory()->getPrevOrNextArticle('next', $contentID, $article->category_id)
        ]);
    }

    public function actionSummary()
    {
        $cnts = Content::find()->all();
        foreach ($cnts as $k => $cnt) {
            if (!($body = ArticleContent::findOne(['content_id'=>$cnt->id]))) {
                continue;
            }
            $cnt->summary = StringHelper::truncate(strip_tags($body->content),120);
            if ($cnt->save()) {
                echo $cnt->id . 'success<br>';
            } else {
                echo $cnt->id . 'fail<br>';
            }
            ob_flush();
            flush();
        }
    }

}
