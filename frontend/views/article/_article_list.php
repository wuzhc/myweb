<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\StringHelper;
?>

<div class="media-body">
    <h4 class="media-heading" style="font-weight: bold">
        <span class="glyphicon glyphicon-tags" style="margin-right: 10px;color: #337ab7"></span>
        <?php echo Html::a(StringHelper::truncate(Html::encode($model->title), 35),['article/view','id'=>$model->id,'parentID'=>$_GET['parentID']],['style'=>array('color'=>'#000000')])?>
    </h4>
    <p style="font-size: 12px;color: #777">
        <span class="glyphicon glyphicon-eye-open"></span>：<?php echo $model->hits;?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="glyphicon glyphicon-calendar"></span>：<?php echo date('Y-m-d', $model->create_at); ?>
    </p>
    <p style='font-size: 14px;line-height:24px;'><?php echo HtmlPurifier::process($model->summary) ?></p>
</div>


