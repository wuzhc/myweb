<?php
use yii\helpers\HtmlPurifier;
use yii\widgets\ListView;
?>
<div class="media-left">
    <a href="#">
        <img class="media-object" src="public/common/images/header.png">
    </a>
</div>
<div class="media-body">
    <h6 class="media-heading"><?=date('Y-m-d H:i:s', $model->create_at)?></h6>
    <?php echo HtmlPurifier::process($model->text) ?>
    <span><a href="<?=\yii\helpers\Url::to(['article/add-comment', 'id' => $model->id])?>">回复</a></span>
    <?php $comments = \common\service\ContentService::factory()->getComments($model->content_id, $model->id)?>
    <?php if (!empty($comments)) { ?>
        <?php echo ListView::widget(array(
            'summary' => '',
            'dataProvider' => $comments,
            'itemView' => '_comment_list',
            'emptyText' => '',
            'options' => ['class' => 'media']
        ))?>
    <?php } ?>
</div>
