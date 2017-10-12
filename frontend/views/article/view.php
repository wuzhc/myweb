<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

$this->title = $content->title;
$this->params['breadcrumbs'][] = array('label'=>$category->title,'url'=>['article/index','cid'=>$category->id,'parentID'=>$category->parent]);
$this->params['breadcrumbs'][] = $content->title;
?>
<?php echo Html::cssFile('public/common/highlightJS/styles/github.css')?>
<?php $this->registerJsFile('@web/public/common/highlightJS/highlight.pack.js',['depends' => \yii\web\JqueryAsset::className()])?>
<?php $this->beginBlock('jquery') ?>
    hljs.initHighlightingOnLoad();
    $('.show-comment').click(function(){
        $('.comment_list').toggle(1000);
    });
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['jquery'], \yii\web\View::POS_END); ?>
<style>
    td{
        border: 1px dashed #c5af75;
    }
    .media:first-child{margin-top: 10px}
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
    <div class="comment-box">
        评论内容：
        <?php
        $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        ]) ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
    <div class="page-header show-comment">
        <h4>查看评论 <small>点击显示列表</small></h4>
    </div>
    <div class="comment_list" style="display: none">
        <?php if (!empty($comments)) { ?>
            <?php echo ListView::widget(array(
                'summary' => '',
                'itemOptions' => array('class'=>'media'),
                'dataProvider' => $comments,
                'itemView' => '_comment_list',
                'emptyText' => '',
            ))?>
        <?php } ?>
    </div>
</div>

