<?php

namespace backend\controllers;

use common\models\Content;
use common\service\ContentService;
use Yii;
use backend\models\AricleSearch;
use yii\helpers\StringHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Content models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AricleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Content model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Content model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Content();

        if ($model->load(Yii::$app->request->post())) {

            $fileInstance = UploadedFile::getInstance($model, 'image_url');
            if ($fileInstance && ($filePath = $model->upload($fileInstance))) {
                $model->image_url = $filePath;
            }

            if (!$model->summary) {
                $model->summary = StringHelper::truncate(strip_tags($model->content),120);
            }

            if ($model->save()) {
                $data['contentID'] = $model->id;
                $data['content'] = $model->content;
                ContentService::factory()->saveArticleContent($data);
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Content model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->content = $model->article->content;

        if ($model->load(Yii::$app->request->post())) {

            $fileInstance = UploadedFile::getInstance($model, 'image_url');
            if ($fileInstance && ($filePath = $model->upload($fileInstance))) {
                $model->image_url = $filePath;
            } else {
                unset($model->image_url);
            }

            if ($model->save()) {
                $data['contentID'] = $model->id;
                $data['content'] = $model->content;
                ContentService::factory()->saveArticleContent($data, ['content_id' => $model->id]);
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing Content model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->article) {
            $model->article->delete();
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Content model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Content the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Content::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
