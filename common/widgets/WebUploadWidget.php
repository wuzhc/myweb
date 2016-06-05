<?php
/**
 * WebUpload
 * @link http://fex.baidu.com/webuploader/
 */
namespace common\widgets;


use yii\base\Widget;
use yii\web\JqueryAsset;

class WebUploadWidget extends Widget
{
    public function init()
    {
        parent::init();
        $view = $this->getView();
        $view->registerCssFile('@web/public/webuploader/webuploader.css');
        $view->registerCssFile('@web/public/webuploader/style.css');
        $view->registerJsFile('http://cdn.staticfile.org/webuploader/0.1.0/webuploader.html5only.min.js', ['depends' => [JqueryAsset::className()]]);
        $view->registerJsFile('@web/public/webuploader/upload.js', ['depends' => [JqueryAsset::className()]]);
    }

    public function run()
    {
        return $this->render('webUpload');
    }
}