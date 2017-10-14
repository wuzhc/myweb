<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

?>
<style>
    #category-label a{margin: 3px; line-height: 30px}
</style>
<form action="<?php echo Url::to(['article/search'])?>" method="post" id="form-search">
    <div class="input-group" style="margin-bottom: 20px">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken()?>">
        <input type="text" name="keyword" class="form-control input-lg" onkeydown="onKeyDown(event)" placeholder="搜索"/>
        <span class="input-group-addon btn btn-primary" id="search-article">搜索</span>
    </div>
</form>

<div class="panel panel-default">
    <div class="panel-body" id="category-label">
        <?php $class = ['label-default', 'label-primary', 'label-success', 'label-danger'];?>
        <?php foreach ($categories as $i => $c) { ?>
            <a href="<?=Url::to(['article/index','parentID'=>$c->parent,'cid'=>$c->id])?>"><span class="label <?=$class[$i%4]?>"><?=$c->title?></span></a>
        <?php } ?>
    </div>
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
                        <?php echo Html::encode(StringHelper::truncate($article->title,22))?>
                    </a>
                    <span class="badge"><?php echo $article->hits; ?></span>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>