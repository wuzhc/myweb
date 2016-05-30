<?php

namespace backend\controllers;

use common\helper\DebugHelper;
use common\helper\FileHelper;
use Yii;
use common\models\File;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FileController implements the CRUD actions for File model.
 */
class FileController extends Controller
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
     * Lists all File models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => File::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        //DebugHelper::dump($dataProvider->getModels());
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single File model.
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
     * Creates a new File model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if ($param = Yii::$app->request->post()) {
            $data = [];
            $category_id = intval($param['category_id']);
            $urlArr = $param['url'];
            $titleArr = $param['title'];

            for ($i = 0, $total = count($urlArr); $i < $total; $i++) {
                $record = [
                    $category_id,
                    $titleArr[$i],
                    Yii::$app->request->hostInfo . '/' . $urlArr[$i],
                    FileHelper::getSize($urlArr[$i]),
                    FileHelper::getExt($urlArr[$i]),
                    time()
                ];
                $data[] = $record;
            }

            File::batchInsert($data);
            return $this->redirect(['index']);
        } else {
            return $this->render('create');
        }
    }

    /**
     * Updates an existing File model.
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
     * Deletes an existing File model.
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
     * Finds the File model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return File the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = File::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTest()
    {
        $filename = 'webuploader/upload/20160530/12198986_113712205177_2.jpg';
        echo FileHelper::getExt($filename);
    }
}
