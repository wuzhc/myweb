<?php
use yii\helpers\HtmlPurifier;
use yii\widgets\ListView;
?>
<div class="media-left">
    <a href="#">
        <img class="media-object" src="<?= Yii::$app->urlManager->baseUrl ?>/public/common/images/header.png">
    </a>
</div>
<div class="media-body">
    <h6 class="media-heading"><?=date('Y-m-d H:i:s', $model->create_at)?></h6>
<!--    --><?php //echo HtmlPurifier::process($model->text) ?>
    <?= \yii\helpers\Html::encode($model->text)?>
    <?php if ($level < 2) { ?>
        <span><a class="thickbox" href="<?=\yii\helpers\Url::to(['article/add-comment', 'width' => 600, 'height' => 400, 'id' => $model->id])?>"><small>评论</small></a></span>
    <?php } ?>
    <?php $comments = \common\service\ContentService::factory()->getComments($model->content_id, $model->id, 0)?>
    <?php if (!empty($comments)) { ?>
        <?php echo ListView::widget(array(
            'summary' => '',
            'dataProvider' => $comments,
            'itemView' => '_comment_list',
            'emptyText' => '',
            'options' => ['class' => 'media'],
            'viewParams' => ['level' => $level + 1]
        ))?>
    <?php } ?>
</div>
