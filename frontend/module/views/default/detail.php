<?php
use yii\helpers\Url;
?>
<article>
    <div style="text-align: center">
        <h2><?=$content->title?></h2>
    </div>

    <div class="time_source">
        <span>时间：<?= date('Y-m-d H:i:s', $content->create_at)?></span>游览：<?php echo $content->hits; ?>
    </div>
    <div class="content">
        <?= $content->article->content;?>
    </div>

</article>

<div class="computer">
    <a href="index.php" target="_blank">查看电脑版</a>
</div>
