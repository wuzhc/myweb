<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = $content->title;
$this->params['breadcrumbs'][] = array('label'=>$category->title,'url'=>['article/index','cid'=>$category->id,'parentID'=>$category->parent]);
$this->params['breadcrumbs'][] = $content->title;
?>
<?php $this->registerCssFile('@web/public/common/highlightJS/styles/github.css')?>
<?php $this->registerCssFile('@web/public/common/css/thickbox.css')?>
<?php $this->registerJsFile('@web/public/common/highlightJS/highlight.pack.js',['depends' => \yii\web\JqueryAsset::className()])?>
<?php $this->registerJsFile('@web/public/common/js/thickbox.js',['depends' => \yii\web\JqueryAsset::className()])?>

<?php $this->beginBlock('jquery') ?>
<!--<script>-->
    hljs.initHighlightingOnLoad();
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['jquery'], \yii\web\View::POS_END); ?>
<style>
    td{border: 1px dashed #c5af75;}
</style>
<div class="container">
    <div>
        <p style="font-size: 24px; text-align: center; color: #000000; font-weight: bold">
            <?php echo Html::encode($content->title) ?>
        </p>
        <p><span class="glyphicon glyphicon-eye-open"></span>：<?php echo $content->hits;?>&nbsp;&nbsp;&nbsp;&nbsp;<!--<span class="glyphicon glyphicon-calendar"></span>：--><?php /*echo date('Y-m-d', $content->create_at)*/?>
            &nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-cog"></span>：<a href="http://wuzhc.top/admin.php?r=article/update&id=<?php echo $content->id?>">edit</a>
        </p>
        <br />
        <p>
        <?php echo $content->article->content?>
        </p>
    </div>

    <div class="prev_next">
        <p>上一篇： <?= !empty($prev) ? Html::a($prev['title'], ['article/view', 'id' => $prev['id']]) : '无'?></p>
        <p>下一篇： <?= !empty($next) ? Html::a($next['title'], ['article/view', 'id' => $next['id']]) : '无'?></p>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">添加评论</div>
                <div class="panel-body">
                    <?php
                        $form = ActiveForm::begin([
                            'id' => 'comment-form',
                            'action' => Url::to(['article/add-comment']),
                            'method' => 'post'
                        ]);
                    ?>
                    <?= $form->field($model, 'text', ['template' => "{input}"])->textarea(['rows' => 8, 'placeholder' => '评论一下吧']) ?>
                    <?= $form->field($model, 'verifyCode', ['template' => "{input}"])->widget(Captcha::className(), [
                        'template' => '<div class="col-lg-1">{image}</div><div class="col-lg-2">{input}</div>',
                    ]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>
                    <?= $form->field($model, 'contentID', ['template' => "{input}"])->input('hidden', ['value' => $content->id])->label('')?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

    <?php if ($comments->getTotalCount() > 0) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">评论列表</div>
                <div class="panel-body">
                    <?php Pjax::begin(['id' => 'comment']) ?>
                    <?php echo ListView::widget(array(
                        'summary' => '',
                        'itemOptions' => array('class'=>'media'),
                        'dataProvider' => $comments,
                        'itemView' => '_comment_list',
                        'emptyText' => '',
                        'viewParams' => ['level' => 1]
                    ))?>
                    <?php Pjax::end()?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
