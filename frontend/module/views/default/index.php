<?php
use yii\helpers\Url;
$this->title = 'Learning Record';
?>
<section class="clear">


    <?php foreach($datas as $key => $data) { ?>

        <!-- begin -->
        <?php if ($data['cats'] && $data['articles']) { ?>
            <div class="tabbed_content">
                <div class="tabs tabs2">
                    <div class="moving_bg">&nbsp;</div>
                    <?php foreach((array)$data['cats'] as $cat) { ?>
                        <span class="tab_item"><?= $cat['title'];?></span>
                    <?php } ?>
                </div>
                <div class="slide_content">
                    <div class="tabslider tabslider3" >
                        <div>&nbsp;</div>
                        <?php foreach((array)$data['articles'] as $catID=>$articles) { ?>
                            <?php if($articles) { ?>
                                <ul>
                                    <?php foreach((array)$articles as $a) { ?>
                                        <li><a href="<?= Url::to(['default/detail','id'=>$a['id']])?>"><?=$a['title']?></a><span><em>浏览 <?= $a['hits']?> 次</em><?= $a['create']?></span></li>
                                    <?php } ?>
                                    <div class="more click_more" style="clear:both;" data-cid="<?=$catID?>" page-offset="10">点击查看更多</div>
                                    <div class="hidden"></div>
                                </ul>
                            <?php }else{?>
                                <ul>
                                    <div class="" style="clear:both;"><article style="text-align: center">暂无内容！</article></div>
                                </ul>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <br style="clear:both" />
                </div>
            </div>
        <?php } ?>
        <!-- end -->

    <?php }?>

</section>

