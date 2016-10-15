<?php

use common\config\Conf;
use common\service\CategoryService;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$baseUrl = Yii::$app->request->baseUrl;

/* @var $this yii\web\View */
/* @var $model common\models\File */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="file-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('标题') ?>
    <?= $form->field($model, 'summary')->textarea(['rows' => 3])->label('简述') ?>
    <?= $form->field($model, 'category_id')->dropDownList(CategoryService::factory()->getCategoriesMap(['model_id' => Conf::ALBUM_MODEL]),['style' => "width:120px;"]) ?>
    <?= $form->field($model, 'sort')->textInput(['value' => 0, 'style' => "width:120px;"])->label('排序') ?>
    <?= $form->field($model, 'status')->radioList(['0' => '已审核', '1' => '未审核'])->label('状态') ?>
    <?= $form->field($model, 'model_id')->hiddenInput(['value' => 2])->label(''); ?>

    <?= \common\widgets\WebUploadWidget::widget()?>

    <div class="form-group">
        <?= Html::submitButton('确定', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>