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



    <div id="w0" class="grid-view"><div class="summary">第<b>1-10</b>条，共<b>18</b>条数据.</div>
        <table class="table table-striped table-bordered"><thead>
            <tr>
                <th>#</th>
                <th><a href="/admin.php?r=file%2Findex&amp;sort=id" data-sort="id">ID</a></th>
                <th><a href="/admin.php?r=file%2Findex&amp;sort=url" data-sort="url">缩列图</a></th>
                <th width="180"><a href="/admin.php?r=file%2Findex&amp;sort=url" data-sort="url">URL</a></th>
                <th><a href="/admin.php?r=file%2Findex&amp;sort=ext" data-sort="ext">Ext</a></th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($dataProvider->getModels() as $k => $d) :?>
            <tr data-key="<?= $d->id?>">
                <td><?= $k + 1?></td>
                <td><?= $d->id?></td>
                <td><a href="http:///webuploader/upload/20160530/IMG_2459.JPG"><?= Html::img(\common\helper\ImageHelper::thumb($d->url, 240, 240))?></a></td>
                <td>&lt;img src="/uploads/thumbs/IMG_2459-aec3fa9bbd6387f24afc5dee595a6fe3.JPG" alt=""&gt;</td>
                <td>JPG</td>
                <td>
                    <a href="/admin.php?r=file%2Fview&amp;id=78" title="查看" aria-label="查看" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>
                    <a href="/admin.php?r=file%2Fupdate&amp;id=78" title="更新" aria-label="更新" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="/admin.php?r=file%2Fdelete&amp;id=78" title="删除" aria-label="删除" data-confirm="您确定要删除此项吗？" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
            <ul class="pagination"><li class="prev disabled"><span>«</span></li>
            <li class="active"><a href="/admin.php?r=file%2Findex&amp;page=1&amp;per-page=10" data-page="0">1</a></li>
            <li><a href="/admin.php?r=file%2Findex&amp;page=2&amp;per-page=10" data-page="1">2</a></li>
            <li class="next"><a href="/admin.php?r=file%2Findex&amp;page=2&amp;per-page=10" data-page="1">»</a></li></ul></div>



    <?/*= GridView::widget([
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
    ]); */?>

</div>
