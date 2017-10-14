<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div>
    <div>
        <div class="modal-content">
            <div class="modal-header">
                <a type="button" class="close" onclick="tb_remove()"><span aria-hidden="true">&times;</span></a>
                <h4 class="modal-title" id="exampleModalLabel">添加评论</h4>
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
                <?= $form->field($model, 'contentID', ['template' => "{input}"])->input('hidden', ['value' => $comment->content_id])->label('')?>
                <?= $form->field($model, 'parentID', ['template' => "{input}"])->input('hidden', ['value' => $comment->id])->label('')?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
