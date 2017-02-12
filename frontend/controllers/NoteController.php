<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017年02月12日
 * Time: 14:28
 */

namespace frontend\controllers;


use Yii;
use common\models\Note;
use yii\data\Pagination;
use yii\web\Controller;

class NoteController extends Controller
{

    public function actionAdd()
    {
        if ($data = Yii::$app->request->post())
        {
            $note = new Note();
            if ($note->load(Yii::$app->request->post()) && $note->validate()) {
                if ($note->save()) {
                    $this->redirect(array('note/add'));
                }
            } else {
                var_dump($note->getErrors());
            }
        }
        else
        {
            $flag = Yii::$app->request->get('flag');
            if ($flag && strcasecmp($flag,'today') ===0) {
                $begin = date('Y-m-d 00:00:00',time());
                $end = date('Y-m-d 23:59:00', time());
                $data = Note::find()->where(['between', 'time', $begin, $end]);
            } else {
                $data = Note::find();
            }

            $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
            $dataModel = $data->offset($pages->offset)->limit($pages->limit)->orderBy(['id'=>SORT_DESC])->all();

            return $this->render('add',[
                'dataModel' => $dataModel,
                'model' => new Note(),
                'pages' => $pages,
            ]);
        }
    }

    /**
     * 标记已完成状态
     * @throws \yii\db\Exception
     */
    public function actionCheck()
    {
        $data = array_filter(Yii::$app->request->post('value'), function($v) {
            return is_numeric($v);
        });

        if ($data) {
            $sql = 'update '.Note::tableName(). ' set status = 2 where id in ('. implode(',',$data) .')';
            Yii::$app->db->createCommand($sql)->execute();
            $this->redirect(array('note/add'));
        } else {
            echo 'ilegal'; exit;
        }
    }
}
