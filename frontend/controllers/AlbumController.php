<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/5
 * Time: 10:51
 */

namespace frontend\controllers;


use common\config\Conf;
use common\helper\DebugHelper;
use common\service\CategoryService;
use common\service\ContentService;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;

class AlbumController extends Controller
{
    public function init()
    {
        $this->layout = 'main_cus';
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = ContentService::factory()->getContents([
            'modelID' => Conf::ALBUM_MODEL,
            'status' => Conf::ENABLE,
            'order' => 'id DESC',
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * @return string
     */
    public function actionView()
    {
        $id = (int)Yii::$app->request->get('id', 207);
        if (empty($id)) {
            throw new \InvalidArgumentException('Invalid Argument');
        }

        $content = ContentService::factory()->getContent(['id' => $id]);
        $album = unserialize($content->imageCtn->content);

        return $this->render('view', [
            'album' => $album,
            'content' => $content
        ]);
    }
}