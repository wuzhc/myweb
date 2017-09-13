<?php

namespace backend\controllers;

use common\helper\FileHelper;
use common\models\Content;
use common\service\ContentService;
use Yii;
use backend\models\AricleSearch;
use yii\filters\AccessControl;
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
                $model->summary = StringHelper::truncate(strip_tags($model->content), 120);
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

        if ($model->load(Yii::$app->request->post())) {

            $fileInstance = UploadedFile::getInstance($model, 'image_url');
            if ($fileInstance && ($filePath = $model->upload($fileInstance))) {
                $model->image_url = $filePath;
            } else {
                unset($model->image_url);
            }

            if (!$model->summary) {
                $model->summary = StringHelper::truncate(strip_tags($model->content), 120);
            }

            if ($model->save()) {
                $data['contentID'] = $model->id;
                $data['content'] = $model->content;
                ContentService::factory()->saveArticleContent($data, ['content_id' => $model->id]);
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        $model->content = $model->article->content;
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

    /**
     * Upload image for WangEditor
     * @since 2016-12-25
     */
    public function actionUploadImgForWangEditor()
    {
        $targetDir = 'uploads/upload_tmp';
        $uploadDir = 'uploads/wangEditor/' . date('Y-m-d');

        $cleanupTargetDir = true;
        FileHelper::createDirectory($targetDir);
        FileHelper::createDirectory($uploadDir);

        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }
        $fileName = iconv('UTF-8', 'GB2312', $fileName);
        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;

        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;

        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                echo 'error|Failed to open temp directory';
                exit;
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
                    continue;
                }

                if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }

        if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
            echo 'error|Failed to open output stream';
            exit;
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                echo 'error|Failed to move uploaded file';
                exit;
            }

            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                echo 'Failed to open input stream';
                exit;
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                echo 'Failed to open input stream';
                exit;
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");

        $index = 0;
        $done = true;
        for ($index = 0; $index < $chunks; $index++) {
            if (!file_exists("{$filePath}_{$index}.part")) {
                $done = false;
                break;
            }
        }
        if ($done) {
            if (!$out = @fopen($uploadPath, "wb")) {
                echo 'error|Failed to open output stream11';
                exit;
            }

            if (flock($out, LOCK_EX)) {
                for ($index = 0; $index < $chunks; $index++) {
                    if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
                        break;
                    }

                    while ($buff = fread($in, 4096)) {
                        fwrite($out, $buff);
                    }

                    @fclose($in);
                    @unlink("{$filePath}_{$index}.part");
                }

                flock($out, LOCK_UN);
            }
            @fclose($out);
        }

        echo './' . $uploadDir . '/' . $fileName;
    }
}
