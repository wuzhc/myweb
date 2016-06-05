<?php

use common\config\Conf;
use common\service\CategoryService;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '新建图集';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('上传图集', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p style="color: #006600;font-size: 18px;margin: 10px 0px;">Tips：表单输入信息后，可按回车键搜索</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'ID',
                'attribute' => 'id',
                'headerOptions' => ['width' => 50],
            ],
            'title',
            //'summary:ntext',
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
                'filter' => CategoryService::factory()->getCategoriesMap(['model_id' => Conf::ALBUM_MODEL]),
                'headerOptions' => ['width' => '130'],
            ],
            [
                'label' => '缩列图',
                'attribute' => 'image_url',
                'format' => 'html',
                'value' => function ($searchModel) {
                    return Html::img(\common\helper\ImageHelper::thumb($searchModel->image_url));
                }
            ],
            // 'hits',
            // 'comments',
            // 'sort',
            // 'status',
             'create_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
