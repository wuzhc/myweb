<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
$this->title = 'Learning Record';

if (is_array($cats)) {
    foreach ($cats as $cat) {
        $template = $cat['id'] == $cid ? "<li style='font-weight: bold;'>{link}</li>\n" : "<li>{link}</li>\n";
        $this->params['breadcrumbs'][] = array(
            'label'=>$cat['title'],
            'url'=>Url::to(['article/index','parentID'=>$parentID,'cid'=>$cat['id']]),
            'template' => $template
        );
    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php echo ListView::widget(array(
                'summary' => '',
                'itemOptions' => array('class'=>'media'),
                'dataProvider' => $articles,
                'itemView' => '_article_list',
                'emptyText' => Html::img(\common\config\Conf::EMPTY_DATA),
            ))?>

        </div>
        <div class="col-md-4">
            <?php echo \common\widgets\LeftCntWidget::widget(); ?>
        </div>
    </div>
</div>