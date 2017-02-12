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

    /**
     * @return string
     * @since 2017-02-12
     */
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
            $noteObj = Note::find();
            $flag = Yii::$app->request->get('flag');
            if ($flag && strcasecmp($flag,'today') === 0) {
                $begin = date('Y-m-d 00:00:00',time());
                $end = date('Y-m-d 23:59:00', time());
                $noteObj->andFilterWhere(['between', 'time', $begin, $end]);
            }

            $status = Yii::$app->request->get('status');
            if ($status && strcasecmp($status,'unfinish') === 0) {
                $noteObj->andFilterWhere(['status' => 1]);
            } elseif ($status && strcasecmp($status,'finish') === 0) {
                $noteObj->andFilterWhere(['status' => 2]);
            } else {
                $noteObj->andFilterWhere(['in','status',[1,2]]);
            }

            $pages = new Pagination(['totalCount' =>$noteObj->count(), 'pageSize' => '20']);
            $dataModel = $noteObj->offset($pages->offset)->limit($pages->limit)->orderBy(['id'=>SORT_DESC])->all();

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
     * @since 2017-02-12
     */
    public function actionCheck()
    {

        $value = Yii::$app->request->post('value');
        if (!is_array($value)) {
            echo 'illegal request'; exit;
        }
        $data = array_filter($value, function($v) {
            return is_numeric($v);
        });

        if ($data) {
            $sql = 'update '.Note::tableName(). ' set status = 2 where id in ('. implode(',',$data) .')';
            Yii::$app->db->createCommand($sql)->execute();
            $this->redirect(array('note/add'));
        } else {
            echo 'empty data'; exit;
        }
    }

    /**
     * Delete record
     * @since 2017-02-12
     */
    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        if (!is_numeric($id)) {
            echo 'illegal request'; exit;
        }

        $isExists = Note::find()->where(['id'=>$id])->exists();
        if (!$isExists) {
            echo 'record is not exists'; exit;
        }

        Note::updateAll(['status'=>3],['id'=>$id]);
        $this->redirect(['note/add']);
    }

}
