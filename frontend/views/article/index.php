<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
$this->title = 'Code Demo';

if (is_array($cats)) {
    foreach ($cats as $cat) {
        $template = $cat['id'] == $cid ? "<li style='font-weight: bold;'>{link}</li>\n" : "<li>{link}</li>\n";
        $this->params['breadcrumbs'][] = array(
            'label'=>$cat['title'],
            'url'=> $cat['url'] ?: Url::to(['article/index','parentID'=>$parentID,'cid'=>$cat['id']]),
            'template' => $template
        );
    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php if ($articles) { ?>
                <?php echo ListView::widget(array(
                    'summary' => '',
                    'itemOptions' => array('class'=>'media'),
                    'dataProvider' => $articles,
                    'itemView' => '_article_list',
                    'emptyText' => '暂无数据！',
                ))?>
            <?php } else { ?>
                暂无数据！
            <?php } ?>

        </div>
        <div class="col-md-4">
            <?php echo \common\widgets\LeftCntWidget::widget(); ?>
        </div>
    </div>
</div>