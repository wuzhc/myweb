<?php

namespace backend\controllers;

use common\helper\DebugHelper;
use common\helper\FileHelper;
use common\models\ImageContent;
use common\service\ContentService;
use Yii;
use common\models\Content;
use backend\models\ImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ImageController implements the CRUD actions for Content model.
 */
class ImageController extends Controller
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
        $searchModel = new ImageSearch();
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

            $urlArr = Yii::$app->request->post('url');
            $titleArr = Yii::$app->request->post('title');
            $model->image_url = $urlArr[0];
            if (!$model->save()) {
                foreach ($model->getErrors() as $errors) {
                    foreach ($errors as $e) {
                        echo $e . '<br>';
                    }
                }
                $this->error('create image fail');
            }

            $content = [];
            for ($i = 0, $total = count($urlArr); $i < $total; $i++) {
                $record = [
                    $titleArr[$i],
                    $urlArr[$i],
                    FileHelper::getSize($urlArr[$i]),
                    FileHelper::getExt($urlArr[$i]),
                ];
                $content[] = $record;
            }

            $data['contentID'] = $model->id;
            $data['content'] = serialize($content);
            ContentService::factory()->saveImageContent($data);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create',[
                'model' => $model,
            ]);
        }


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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Content model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

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
