<?php
use yii\bootstrap\Html;
$this->title = $content->title;
?>
<div class="clearfix"></div>
<!--start body-->
<div class="gray_full_bg">
    <div class="hosting_plans">
        <div class="container">
            <div style="color: #00aa00;font-size: 24px;font-weight: bold;text-align: center; background-color: #ffffff;height:auto;line-height:30px;padding: 10px 10px;">
                <?= Html::encode($content->title)?>
                <br>
                <span style="color: orange;font-size: 12px;">
                    <?= Html::encode($content->author->username) ?>
                    <?= date('Y-m-d H:i:s', $content->create_at)?>
                </span>
            </div>
            <!--新添加的start-->
            <div class="row">
                <div id="fh5co-board" data-columns>
                    <?php foreach($album as $a): ?>
                        <div class="item">
                            <div class="animate-box">
                                <a href="<?= $a[1]?>" class="image-popup fh5co-board-img" title="<?= $a[0]?>"><img src="<?= $a[1]?>" alt="<?= $a[0]?>"></a>
                            </div>
                            <div class="fh5co-desc"><?= $a[0]?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!--新添加的end-->

        </div>
    </div><!-- end all hosting plans -->
</div>
<!--end body-->
