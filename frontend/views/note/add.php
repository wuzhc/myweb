<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017年02月12日
 * Time: 14:45
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = '问题记录';
?>

<div class="row">
    <div class="col-xs-6">
        <div style="margin-bottom: 10px">
            <h3 style="display: inline">问题汇总</h3>  <?= Html::a('查看今天问题', \yii\helpers\Url::to(['note/add','flag'=>'today'])) ?>
        </div>
        <form action="<?= \yii\helpers\Url::to(['note/check'])?>" method="post">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam?>" value="<?= Yii::$app->request->getCsrfToken()?>">
            <?php
            foreach($dataModel as $key=>$val)
            {
                if ($val->status == 2) {
                    echo '✔&nbsp;&nbsp;';
                } else {
                    echo '<input type="checkbox" value="'. $val->id .'" name="value[]">&nbsp;&nbsp;';
                }

                echo $key + 1, '：';
                echo \yii\bootstrap\Html::encode($val->content);
                echo '&nbsp;&nbsp;&nbsp;',date('Y-m-d', strtotime($val->time));
                echo '<br>';
            }
            ?>
            <br>
            <?= Html::submitButton('标记为完成状态', ['class'=>'btn btn-danger','name' =>'submit-button']) ?>
        </form>
        <?= LinkPager::widget(['pagination' => $pages]); ?>
    </div>
    <div class="col-xs-6">
        <?php $form = ActiveForm::begin(['action' => ['note/add'],'method'=>'post',]); ?>
        <?= $form->field($model, 'content')->textarea(['cols' => 3, 'rows' => 2])->label('问题描述') ?>
        <?= Html::submitButton('提交问题', ['class'=>'btn btn-primary','name' =>'submit-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>


