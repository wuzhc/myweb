<?php

use common\service\CategoryService;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$baseUrl = Yii::$app->request->baseUrl;

/* @var $this yii\web\View */
/* @var $model common\models\File */
/* @var $form yii\widgets\ActiveForm */
?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl?>/webuploader/webuploader.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl?>/webuploader/style.css" />

<div class="file-form">

    <?php ActiveForm::begin(); ?>

    <label class="control-label" for="file-category_id"></label>
    <select id="file-category_id" class="form-control" name="category_id" style="width: 150px">
        <?php $categories = CategoryService::factory()->getCategoriesMap(['condition' => ['parent' => 2]]); ?>
        <?php foreach ($categories as $id => $title): ?>
        <option value="<?= $id?>"><?= $title;?></option>
        <?php endforeach; ?>
    </select>
    <div class="help-block"></div>

    <div id="wrapper">
        <div id="container">
            <!--头部，相册选择和格式选择-->
            <div id="uploader">
                <div class="queueList">
                    <div id="dndArea" class="placeholder">
                        <div id="filePicker"></div>
                        <p>或将照片拖到这里，单次最多可选300张</p>
                    </div>
                </div>
                <div id="hasUploadFile"></div>
                <div class="statusBar" style="display:none;">
                    <div class="progress">
                        <span class="text">0%</span>
                        <span class="percentage"></span>
                    </div><div class="info"></div>
                    <div class="btns">
                        <div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="help-block"></div>

    <div class="form-group">
        <?= Html::submitButton('确定', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://cdn.staticfile.org/webuploader/0.1.0/webuploader.html5only.min.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/webuploader/upload.js"></script>