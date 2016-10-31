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

<div class="container">
    <div>
        <p style="font-size: 24px; text-align: center; color: #000000; font-weight: bold">
            <?php echo Html::encode($content->title) ?>
        </p>
        <p>游览数：<?php echo $content->hits;?>&nbsp;&nbsp;&nbsp;&nbsp;发布日期：<?php echo date('Y-m-d', $content->create_at)?></p>
        <br />
        <p>
        <?php echo $content->article->content?>
        </p>
    </div>
</div>

