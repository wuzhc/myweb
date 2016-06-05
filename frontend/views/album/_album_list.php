<?php
use yii\bootstrap\Html;
use yii\helpers\Url;
?>
<div class="one_fourth">
    <div class="portfolio_image">
        <a class="fancybox" href="<?= Url::to(['album/view', 'id' => $model->id]);?>" data-fancybox-group="gallery" title="Publishing packages">
            <?= Html::img(\common\helper\ImageHelper::thumb($model->image_url, 220, 130))?>
        </a>
        <div class="title"><?= Html::encode($model->title)?></div>
    </div>
</div>