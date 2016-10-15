<?php use yii\helpers\Url;

foreach((array)$datas as $data) { ?>
    <div><a href="<?= Url::to(['default/detail','id'=>$data->id])?>"><?= $data->title?></a><span><em>浏览 <?= $data->hits?> 次</em><?= date('Y-m-d',$data->create_at)?></span></div>
<?php } ?>