<?php

use common\helper\ImageHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'summary:ntext',
            [
                'label' => '作者',
                'attribute' => 'author.username',
            ],
            [
                'label' => '所属类别',
                'attribute' => 'category.title',
            ],
            [
                'label' => '缩列图',
                'attribute' => 'image_url',
                'format' => 'html',
                'value' => Html::img(\common\helper\ImageHelper::thumb($model->image_url))
            ],
            'hits',
            'comments',
            'sort',
            [
                'label' => '状态',
                'attribute' => 'status',
                'value' => $model->status === 0 ? '已审核' : '未审核',
            ],
            'create_at:datetime:创建日期',
        ],
    ]) ?>

</div>
