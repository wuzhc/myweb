<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\service\CategoryService;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类';
$this->params['breadcrumbs'][] = $this->title;

$categories = CategoryService::factory()->getCategoriesMap();
?>
<div class="categories-index">

    <p>
        <?= Html::a('新建类别', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p style="color: #006600;font-size: 18px;margin: 10px 0px;">Tips：表单输入信息后，可按回车键搜索</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'level',
                'attribute' => 'level',
                'headerOptions' => ['width' => '100']
            ],
            [
                'label' => 'ID',
                'attribute' => 'id',
                'headerOptions' => ['width' => '100']
            ],
            [
                'label' => '类名',
                'attribute' => 'title',
                'headerOptions' => ['width' => '180']
            ],
            [
                'label' => '所属父类',
                'attribute' => 'parent',
                'value' => function ($searchModel) use ($categories) {
                    $id = $searchModel->parent;
                    return $categories[$id];
                },
                'filter' => CategoryService::factory()->getCategoriesMap(),
                'headerOptions' => ['width' => '180'],
            ],
            [
                'label' => '排序',
                'attribute' => 'sort',
                'filter' => ['desc' => '降序', 'asc' => '升序'],
                'headerOptions' => ['width' => '100'],
            ],
            [
                'label' => '创建时间',
                'attribute' => 'create_at',
                'value' => function ($searchModel) {
                    return date('Y-m-d H:i:s', $searchModel->create_at);
                },
                'headerOptions' => ['width' => '180']
            ],
            [
                'label'=>'状态',
                'attribute' => 'status',
                'value' => function ($searchModel) {
                    $state = [
                        '0' => '已审核',
                        '1' => '未审核',
                    ];
                    return $state[$searchModel->status];
                },
                'filter' => ['0' => '已审核', '1' => '未审核'],
                'headerOptions' => ['width' => '120']
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
