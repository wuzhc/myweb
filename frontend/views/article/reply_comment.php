<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">回复评论</h4>
            </div>
            <div class="modal-body">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'comment-form',
                    'action' => Url::to(['article/add-comment']),
                    'method' => 'post'
                ]);
                ?>
                <?= $form->field($model, 'text', ['template' => "{input}"])->textarea(['rows' => 8, 'placeholder' => '']) ?>
                <?= $form->field($model, 'verifyCode', ['template' => "{input}"])->widget(Captcha::className(), [
                    'template' => '<div class="col-lg-2">{image}</div><div class="col-lg-2">{input}</div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
                <?= $form->field($model, 'contentID', ['template' => "{input}"])->input('hidden', ['value' => $content->id])->label('')?>
                <?= $form->field($model, 'parentID', ['template' => "{input}"])->input('hidden')->label('')?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary">确定</button>
            </div>
        </div>
    </div>
</div>
