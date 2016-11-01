<?php

use common\config\Conf;
use common\service\CategoryService;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('标题') ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6])->label('简述') ?>

    <?= \common\widgets\SimditorWidget::widget(['model' => $model])?>

    <?= $form->field($model, 'category_id')->dropDownList(CategoryService::factory()->getCategoriesMap(['model_id' => Conf::ARTICLE_MODEL])) ?>

    <?/*= $form->field($model, 'image_url')->fileInput() */?>

    <?/*= $form->field($model, 'hits')->textInput(['value' => 0])->label('点击数') */?>

    <?/*= $form->field($model, 'comments')->textInput(['value' => 0])->label('评论数') */?>

    <?= $form->field($model, 'sort')->textInput(['value' => 0,'style'=>'width:100px'])->label('排序') ?>

    <?/*= $form->field($model, 'status')->radioList(['0' => '已审核', '1' => '未审核'])->label('状态') */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
