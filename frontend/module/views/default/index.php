<?php
use yii\helpers\Url;
?>
<section class="clear">


    <?php foreach($datas as $key => $data) { ?>

        <!-- begin -->
        <?php if ($data['cats'] && $data['articles']) { ?>
            <div class="tabbed_content">
                <div class="tabs tabs3">
                    <div class="moving_bg">&nbsp;</div>
                    <?php foreach((array)$data['cats'] as $cid => $title) { ?>
                        <a class="tab_item" href="<?= Url::to(['default/list','cid'=>$cid])?>"><?= $title;?></a>
                    <?php } ?>
                </div>
                <div class="slide_content">
                    <div class="tabslider tabslider3" >
                        <div>&nbsp;</div>
                        <?php foreach((array)$data['articles'] as $catID=>$articles) { ?>
                            <ul>
                                <?php foreach((array)$articles as $a) { ?>
                                    <li><a href="<?= Url::to(['default/detail','id'=>$a['id']])?>"><?=$a['title']?></a><span><em>浏览 <?= $a['hits']?> 次</em><?= $a['create']?></span></li>
                                <?php } ?>
                                <div class="more click_more" style="clear:both;" data-cid="<?=$catID?>">点击查看更多</div>
                                <div class="hidden"></div>
                            </ul>
                        <?php } ?>
                    </div>
                    <br style="clear:both" />
                </div>
            </div>
        <?php } ?>
        <!-- end -->

    <?php }?>

</section>

