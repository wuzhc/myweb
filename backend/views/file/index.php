<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create File', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'article_id',
            'type_id',
            'url:url',
            [
                'label' => '缩列图',
                'attribute' => 'url',
                'format' => 'html',
                'value' => function ($searchModel) {
                    $thumb = \common\helper\ImageHelper::thumb($searchModel->url, 50, 50);
                    return Html::img($thumb);
                },
                'headerOptions' => ['width' => '180'],
            ],
            'ext',
            // 'size',
            // 'create_at',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
