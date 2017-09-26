<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
$this->title = $content->title;
$this->params['breadcrumbs'][] = array('label'=>$category->title,'url'=>['article/index','cid'=>$category->id,'parentID'=>$category->parent]);
$this->params['breadcrumbs'][] = $content->title;
?>
<?php echo Html::cssFile('public/common/highlightJS/styles/github.css')?>
<?php $this->registerJsFile('@web/public/common/highlightJS/highlight.pack.js',['depends' => \yii\web\JqueryAsset::className()])?>
<?php $this->beginBlock('jquery') ?>
    hljs.initHighlightingOnLoad();
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['jquery'], \yii\web\View::POS_END); ?>
<style>
    td{
        border: 1px dashed #c5af75;
    }
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
</div>

