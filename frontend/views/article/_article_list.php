<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\helper\ImageHelper;
use yii\helpers\StringHelper;
?>
<div class="blog_post">
    <div class="blog_postcontent">
        <div class="image_frame small">
            <?= Html::a(Html::img(ImageHelper::thumb($model->image_url, 318, 140)), ['article/view', 'id' => $model->id])?>
        </div>
        <div class="post_info_content_small">
            <a href="blog-archive.html" class="date"><strong><?= date('d',$model->create_at)?></strong><i><?= date('Y-m',$model->create_at)?></i></a>
            <h3><?= Html::a(StringHelper::truncate(Html::encode($model->title), 28), ['article/view', 'id' => $model->id]) ?></h3>
            <ul class="post_meta_links_small">
                <li class="post_by"><a href="#"><?= Html::encode($model->author->username); ?></a></li>
                <li class="post_categoty"><a href="#">0收藏</a></li>
                <li class="post_comments"><a href="#"><?= $model->comments?>评论</a></li>
                <li class="post_comments"><a href="#"><?= $model->hits?>访问</a></li>
            </ul>
            <div class="clearfix"></div>
            <p>
                <?= StringHelper::truncate(HtmlPurifier::process($model->summary), 80) ?>
            </p>
        </div>
    </div>
</div>
<div class="clearfix divider_line3"></div>