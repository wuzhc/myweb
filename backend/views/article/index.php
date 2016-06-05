<?php

use common\config\Conf;
use common\service\CategoryService;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AricleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p style="color: #006600;font-size: 18px;margin: 10px 0px;">Tips：表单输入信息后，可按回车键搜索</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'summary',
            [
                'label' => '作者',
                'attribute' => 'user_id',
                'value' => function($searchModel) {
                    return $searchModel->author->username;
                },
                'headerOptions' => ['width' => '100'],
            ],
            [
                'label' => '所属类别',
                'attribute' => 'category_id',
                'value' => function($searchModel) {
                    return $searchModel->category->title;
                },
                'filter' => CategoryService::factory()->getCategoriesMap(['model_id' => Conf::ARTICLE_MODEL]),
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

            // 'image_url:url',
            // 'hits',
            // 'comments',
            // 'sort',
            // 'status',
            // 'create_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
