<?php

namespace frontend\controllers;

use common\config\Conf;
use common\helper\DebugHelper;
use common\models\ArticleContent;
use common\models\Categories;
use common\models\Comment;
use common\models\Content;
use common\service\CategoryService;
use common\service\ContentService;
use frontend\models\CommentForm;
use Yii;
use yii\filters\AccessControl;
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
        // 大分类ID
        $baseCID = Yii::$app->request->get('parentID');
        // 小分类ID
        $cid = Yii::$app->request->get('cid');
        if (empty($baseCID) && empty($cid)) {
            $articles = ContentService::factory()->getContents(array(
                'status' => Conf::ENABLE,
                'order' => 'sort DESC, id DESC',
            ), 10);
            return $this->render('index', array(
                'articles' => $articles,
                'cats' => array(),
            ));
        }

        $childrenCats = CategoryService::factory()->getChildCategories($baseCID);
        // cid可无
        if ($cid && !in_array($cid, ArrayHelper::getColumn($childrenCats, 'id'))) {
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
            ), 10);
        }
        return $this->render('index', array(
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

        Content::updateAllCounters(['hits' => 1], ['id' => $contentID]);

        return $this->render('view', [
            'model' => new CommentForm(),
            'content' => $article,
            'category' => Categories::findOne($article->category_id),
            'comments' => ContentService::factory()->getComments($contentID),
            'prev' => ContentService::factory()->getPrevOrNextArticle('prev', $contentID, $article->category_id),
            'next' => ContentService::factory()->getPrevOrNextArticle('next', $contentID, $article->category_id)
        ]);
    }

    /**
     * 添加评论
     * @since 2017-10-13
     */
    public function actionAddComment()
    {
        $model = new CommentForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', '添加成功.');
            } else {
                Yii::$app->session->setFlash('error', '添加失败.');
            }
            $this->redirect(Yii::$app->request->referrer);
        } else {
            $id = Yii::$app->request->get('id');
            if (empty($id) || (!$comment = Comment::findOne($id))) {
                Yii::$app->session->setFlash('error', '评论不存在.');
                $this->redirect(Yii::$app->request->referrer);
                exit;
            }
            return $this->renderPartial('reply_comment', [
                'model' => $model,
                'comment' => $comment
            ]);
        }
    }

    /**
     * 搜索页面
     * @return string
     */
    public function actionSearch()
    {
        $keyword = strip_tags(trim($_POST['keyword']));
        $articles = ContentService::factory()->getContents(array(
            'status' => Conf::ENABLE,
            'order' => 'sort Desc, id Desc',
            'keyword' => $keyword
        ), 10);
        return $this->render('search', array(
            'articles' => $articles,
        ));
    }

    public function actionSummary()
    {
        $cnts = Content::find()->all();
        foreach ($cnts as $k => $cnt) {
            if (!($body = ArticleContent::findOne(['content_id' => $cnt->id]))) {
                continue;
            }
            $cnt->summary = StringHelper::truncate(strip_tags($body->content), 120);
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
