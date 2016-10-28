<?php
use yii\helpers\Url;
$this->title = $catName;
?>
<section class="clear">

    <div class="tabbed_content">
        <div class="tabs" style="position:static">
            <h2><?= $catName?></h2>
        </div>

        <div class="slide_content" style="position:static;">
            <?php if ($datas) { ?>
            <div class="tabslider">
                <div>&nbsp;</div>
                <ul class="data-list">
                    <?php foreach((array)$datas as $data) { ?>
                        <li><a href="<?= Url::to(['default/detail','id'=>$data->attributes['id']])?>"><?= $data->attributes['title']?></a><span><em>浏览 <?= $data->attributes['hits']?> 次</em><?= date('Y-m-d H:i:s',$data->attributes['create_at'])?></span></li>
                    <?php } ?>
                    <div class="hidden" style="display:block;">
                    </div>
                    <div class="more click_more" style="clear:both;" page-offset="10" data-cid="<?=$data->attributes['category_id']?>">点击查看更多</div>
                </ul>
            </div>
            <?php } else { ?>
                <div style="margin-top: 20px;margin-bottom: 20px">暂无内容！</div>
            <?php } ?>
            <br style="clear:both" />
        </div>

    </div>
    <!-- 电子新闻&设计应用&牛人夜话&暴力拆解 end -->

</section>

