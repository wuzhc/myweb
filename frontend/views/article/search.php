<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
$this->title = '搜索结果';

?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php if ($articles) { ?>
                <?php echo ListView::widget(array(
                    'summary' => '',
                    'itemOptions' => array('class'=>'media'),
                    'dataProvider' => $articles,
                    'itemView' => '_article_list',
                    'emptyText' => '暂无数据！',
                ))?>
            <?php } else { ?>
                暂无数据！
            <?php } ?>

        </div>
        <div class="col-md-4">
            <?php echo \common\widgets\LeftCntWidget::widget(); ?>
        </div>
    </div>
</div>