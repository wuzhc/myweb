<?php use yii\bootstrap\Html;
use yii\helpers\Url;

$this->beginPage() ?>
    <!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
        <title>wuzhc博客</title>
        <meta name="description" content="wuzhc博客" />
        <meta name="keywords" content="wuzhc博客" />
        <?= Html::cssFile('public/frontend/app/css/2014/m/style131017.css')?>
        <!-- media queries css -->
        <?= Html::cssFile('public/frontend/app/css/2014/m/media_queries.css')?>
        <!-- html5.js for IE less than 9 -->
        <?= Html::jsFile('public/frontend/app/js/2014/m/html5shiv.js')?>
        <!--[if lt IE 9]>
        <?= Html::jsFile('public/frontend/app/js/2014/m/html5shiv.js')?>
        <![endif]-->
        <!-- css3-mediaqueries.js for IE less than 9 -->
        <!--[if lt IE 9]>
        <?= Html::jsFile('public/frontend/app/js/2014/m/css3-mediaqueries.js')?>
        <![endif]-->
        <?= Html::jsFile('public/frontend/app/js/2014/m/jquery-1.5.min.js')?>
        <?= Html::jsFile('public/frontend/app/js/2014/m/common.js')?>
        <?= Html::jsFile('public/frontend/app/js/2014/m/list.js')?>
        <?= Html::jsFile('public/frontend/app/js/2014/m/click_more.js')?>
        <?= Html::jsFile('public/frontend/app/js/2014/m/top.js')?>
        <script>
            <!--
            function getOs() {
                var OsObject = "";
                //IE
                if(navigator.userAgent.indexOf("MSIE")>0) { return -1; }
                //火狐
                if(isFirefox=navigator.userAgent.indexOf("Firefox")>0){ return -1; }
                //360极速
                if(isSafari=navigator.userAgent.indexOf("Safari")>0) { return -2; }
                //谷歌
                if(isCamino=navigator.userAgent.indexOf("Camino")>0){ return -2; }
                //火狐
                if(isMozilla=navigator.userAgent.indexOf("Gecko/")>0){ return -1; }
            }
            -->
        </script>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <!-- header begin -->
    <header>
        <div class="loc_logo_nav">
            <div class="loc_logo_navbtn">
                <div class="loc_logo">
                    <div class="logo">
                        <h1><a href="<?= Url::to(['default/index'])?>">wuzhc博客</a></h1>
                    </div>
                </div>
                <div class="navbtn" id="navbtn"></div>
            </div>
            <nav>
                <ul>
                    <?php $baseCatIDs = array_keys(Yii::$app->params['baseCats']);?>
                    <?php $cats = \common\service\CategoryService::factory()->getChildCategories($baseCatIDs)?>
                    <?php foreach((array)$cats as $cid => $title) { ?>
                    <li><a href="<?= Url::to(['default/list','cid'=>$cid])?>"><?= $title?></a></li>
                    <?php } ?>
                    <div class="clear"></div>
                </ul>
            </nav>
        </div>
        <div class="clear"></div>
    </header>
    <!-- header end -->

    <?= Html::jsFile('public/frontend/app/js/2014/m/tabbedContent.js')?>
    <?/*= Html::jsFile('public/frontend/app/js/2014/m/jquery.mobile-1.0a4.1.min.js')*/?>

    <?= $content; ?>

    <div id="top">
        <img src="public/frontend/app/images/2014/m/top_icon_31x11.png" id="goTopBtn">
    </div>

    <!-- footer begin -->
    <footer>
        <p class="fontArial">The blog has been created at 2016 by wuzhc.</p>
    </footer>
    <!-- footer end -->

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>