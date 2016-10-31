<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
?>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">最新动态</div>
    <?php if (!is_array($latest)) { ?>
        <div class="panel-body">
            <p>暂无内容！</p>
        </div>
    <?php } else { ?>
    <ul class="list-group">
        <?php foreach ($latest as $key => $article) { ?>
            <li class="list-group-item" style="position: relative">
                    <?php if ($key > 2) { ?>
                        <span class="label label-primary"><?php echo $key + 1; ?></span>
                    <?php } elseif ($key == 0) { ?>
                        <span class="label label-danger"><?php echo $key + 1; ?></span>
                    <?php } elseif ($key == 1) { ?>
                        <span class="label label-warning"><?php echo $key + 1; ?></span>
                    <?php } elseif ($key == 2) { ?>
                        <span class="label label-success"><?php echo $key + 1; ?></span>
                    <?php } ?>

                    <a href="<?php echo Url::to(['article/view','id'=>$article->id])?>">
                        <?php echo Html::encode(StringHelper::truncate($article->title,22))?>
                    </a>
                    <span style="position: absolute;right: 5px;font-size: 10px"><?php echo date('Y-m-d',$article->create_at) ?></span>
            </li>
        <?php } ?>
    </ul>
    <?php } ?>
</div>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">阅读排行</div>
    <?php if (!is_array($rank)) { ?>
        <div class="panel-body">
            <p>暂无内容！</p>
        </div>
    <?php } else { ?>
        <ul class="list-group">
            <?php foreach ($rank as $key => $article) { ?>
                <li class="list-group-item">
                    <?php if ($key > 2) { ?>
                        <span class="label label-primary"><?php echo $key + 1; ?></span>
                    <?php } elseif ($key == 0) { ?>
                        <span class="label label-danger"><?php echo $key + 1; ?></span>
                    <?php } elseif ($key == 1) { ?>
                        <span class="label label-warning"><?php echo $key + 1; ?></span>
                    <?php } elseif ($key == 2) { ?>
                        <span class="label label-success"><?php echo $key + 1; ?></span>
                    <?php } ?>

                    <a href="<?php echo Url::to(['article/view','id'=>$article->id])?>">
                        <?php echo Html::encode(StringHelper::truncate($article->title,24))?>
                    </a>
                    <span class="badge"><?php echo $article->hits; ?></span>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>