<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $content->title;
?>
<?php echo Html::cssFile('public/common/highlightJS/styles/hopscotch.css')?>
<?php echo Html::jsFile('public/common/highlightJS/highlight.pack.js')?>
<script >hljs.initHighlightingOnLoad();</script>

<!--<link href="http://cdn.bootcss.com/highlight.js/8.0/styles/monokai_sublime.min.css" rel="stylesheet">
<script src="http://cdn.bootcss.com/highlight.js/8.0/highlight.min.js"></script>
<script >hljs.initHighlightingOnLoad();</script>-->

<article>
    <div style="text-align: center">
        <h2><?=$content->title?></h2>
    </div>

    <div class="time_source">
        <span>时间：<?= date('Y-m-d', $content->create_at)?></span>游览：<?php echo $content->hits; ?>
    </div>
    <div class="content">
        <?= $content->article->content;?>
    </div>

</article>

<div class="computer">
    <a href="index.php" target="_blank">查看电脑版</a>
</div>
