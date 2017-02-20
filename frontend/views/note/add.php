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

$this->title = 'Note Record';
?>

<div class="row">
    <div class="col-xs-12 col-md-8">
        <div style="margin-bottom: 10px">
            <h3 style="display: inline">Note Record</h3>&nbsp;&nbsp;
            <?= Html::a('(今天记录)', Url::to(['note/add','flag'=>'today'])) ?>
            <?= Html::a('(未查看)', Url::to(['note/add','status'=>'unfinish'])) ?>
            <?= Html::a('(已查看)', Url::to(['note/add','status'=>'finish'])) ?>
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
            <?= Html::submitButton('标记为已查看状态', ['class'=>'btn btn-danger','name' =>'submit-button']) ?>
        </form>
        <?= LinkPager::widget(['pagination' => $pages]); ?>
    </div>
    <div class="col-xs-6 col-md-4">
        <br>
        <?php $form = ActiveForm::begin(['action' => ['note/add'],'method'=>'post',]); ?>
        <?= $form->field($model, 'content')->textarea(['style'=>'width:100%'])->label('内容描述') ?>
        <?= Html::submitButton('提交内容', ['class'=>'btn btn-default','name' =>'submit-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>



