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
use yii\helpers\Url;

$this->title = '问题记录';
?>

<div class="row">
    <div class="col-xs-12 col-md-8">
        <div style="margin-bottom: 10px">
            <h3 style="display: inline">问题汇总</h3>&nbsp;&nbsp;
            <?= Html::a('(查看今天问题)', Url::to(['note/add','flag'=>'today'])) ?>
            <?= Html::a('(查看未完成问题)', Url::to(['note/add','status'=>'unfinish'])) ?>
            <?= Html::a('(查看已完成问题)', Url::to(['note/add','status'=>'finish'])) ?>
        </div>
        <form action="<?= Url::to(['note/check'])?>" method="post">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam?>" value="<?= Yii::$app->request->getCsrfToken()?>">
            <ul class="list-group">
                <?php foreach($dataModel as $key=>$val) { ?>
                <li class="list-group-item">
                    <?php if ($val->status == 2) { ?>
                        <span style="color:green;">✔</span>
                    <?php } else { ?>
                        <span><input type="checkbox" value="<?=$val->id?>" name="value[]"></span>
                    <?php } ?>
                    <span><?= $key + 1?>.</span>
                    <?=Html::a('删除',Url::to(['note/delete','id'=>$val->id]),['class'=>'badge','style'=>'background-color:#d9534f'])?>
                    <span class="badge" style="background-color: #337ab7"><?=date('Y-m-d', strtotime($val->time))?></span>
                    <?=\yii\bootstrap\Html::encode($val->content)?>
                </li>
                <?php } ?>
            </ul>
            <br>
            <?= Html::submitButton('标记为完成状态', ['class'=>'btn btn-danger','name' =>'submit-button']) ?>
        </form>
        <?= LinkPager::widget(['pagination' => $pages]); ?>
    </div>
    <div class="col-xs-6 col-md-4">
        <br>
        <?php $form = ActiveForm::begin(['action' => ['note/add'],'method'=>'post',]); ?>
        <?= $form->field($model, 'content')->textarea(['style'=>'width:100%'])->label('问题描述') ?>
        <?= Html::submitButton('提交问题', ['class'=>'btn btn-default','name' =>'submit-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>



