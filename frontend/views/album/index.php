<?php
use yii\helpers\Html;
use yii\widgets\ListView;
$this->title = '相册';
?>
<div class="clearfix"></div>
<div class="container">
    <div class="content_fullwidth">
        <!-- start section -->
        <h2>Image with Lightboxes</h2>
        <?= ListView::widget([
            'summary' => '',
            'dataProvider' => $dataProvider,
            'itemView' => '_album_list',
            'emptyText' => Html::img(\common\config\Conf::EMPTY_DATA),
        ])?>
        <!-- end section -->
    </div>

</div>
<div class="clearfix mar_top4"></div>