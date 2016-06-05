<?php
/**
 * Simditor
 * @link https://github.com/mycolorway/simditor/releases
 */

namespace common\widgets;


use yii\base\Widget;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;

class SimditorWidget extends Widget
{
    public $model;

    public function init()
    {
        parent::init();
        $view = $this->getView();
        $view->registerCssFile('@web/public/simditor/styles/simditor.css');
        $view->registerJsFile('@web/public/simditor/scripts/module.js', ['depends' => [JqueryAsset::className()]]);
        $view->registerJsFile('@web/public/simditor/scripts/hotkeys.js', ['depends' => [JqueryAsset::className()]]);
        $view->registerJsFile('@web/public/simditor/scripts/uploader.js', ['depends' => [JqueryAsset::className()]]);
        $view->registerJsFile('@web/public/simditor/scripts/simditor.js', ['depends' => [JqueryAsset::className()]]);
    }

    public function run()
    {
        $this->view->registerJs(
            '$("document").ready(function(){
                var editor = new Simditor({
                    textarea: $("#editor"),
                    toolbar:[
                    "title","bold","italic","underline","strikethrough","color","ol","ul",
                    "blockquote","code","table","link","image","hr","indent","outdent","alignment"
                    ],
                    upload : {
                        url : "'.Url::to(["image/upload"]).'",
                        params : null,
                        fileKey : "imageUrl",
                        connectionCount : 3,
                        leaveConfirm : "正在上传文件"
                    },
                    success: function(data) {
                        alert(data);
                    },
                });
            });'
        );
        echo Html::activeTextarea($this->model, 'content', ['id' => 'editor', 'cols' => 2]);
    }

}