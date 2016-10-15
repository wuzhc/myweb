<?php
use common\service\CategoryService;
use yii\helpers\Html;
use frontend\assets\WebAsset;
use yii\helpers\Url;
WebAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html>
    <head lang="zh-cn">
        <title><?= Html::encode($this->title) ?></title>

        <meta charset="utf-8">
        <meta name="keywords" content="" />
        <meta name="description" content="" />

        <!-- Favicon -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- this styles only adds some repairs on idevices  -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
        <script src="js/html5.js"></script>
        <![endif]-->
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class="site_wrapper">
        <!-- start top -->
        <div class="container_full">
            <!-- start top links -->
            <div class="top_links">
                <div class="container">
                    <div class="contact_info">
                        <ul>
                            <li>联系我:</li>
                            <li class="icons"><img src="http://easyii.cm/public/images/top-phone-icon.png" alt="" />14718070574</li>
                            <li class="icons"><img src="http://easyii.cm/public/images/top-mail-icon.png" alt="" /><a href="wzc1716220125.com">wzc1716220125@163.com</a></li>
                            <li><a href="#">登录</a>  &nbsp;|&nbsp;</li>
                            <li><a href="#">注册</a>  &nbsp;|&nbsp;</li>
                            <li><a href="#">帮助</a>  &nbsp;&nbsp;|&nbsp;</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end top links -->
            <div class="top_section">
                <div class="container">
                    <div id="logo"><a href="<?= Url::to(['article/index']) ?>" class="site_logo"><h1>welcome</h1></a></div><!-- end logo -->
                    <nav id="access" class="access" role="navigation">
                        <div id="menu" class="menu">
                            <ul id="tiny">
                                <li>
                                    <a href="<?= Url::to(['album/index']) ?>" class="active"><b>相册</b></a>
                                </li>
                                <?php $navs = CategoryService::factory()->getHomePageNav(); ?>
                                <?php foreach($navs as $id => $title): ?>
                                    <li><a href="<?= Url::to(['article/index','id' => $id]) ?>"><?= Html::encode($title)?></a>
                                    <?php if($children = CategoryService::factory()->getChildCategories($id)):?>
                                        <ul>
                                            <?php foreach($children as $idd => $titlee): ?>
                                                <li><a href="<?= Url::to(['article/index','id' => $idd]) ?>"><?= Html::encode($titlee)?></a></li>
                                            <?php endforeach;?>
                                        </ul>
                                    <?php endif; ?>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- end top -->
        <div class="clearfix"></div>
        <?= $content ?>
        <div class="clearfix"></div>
        <!--start footer-->
        <div class="footer">
            <div class="footer_center">
                <div class="container">
                    <div class="one_third">
                        <div class="white_bobox">
                            <ul class="whats_included_list">
                                <li><img src="http://easyii.cm/public/images/features-icon1.png" alt="" />flatty红色大气的管理系统模板</li>
                                <li><img src="http://easyii.cm/public/images/features-icon2.png" alt="" />精仿苏宁电器商城网站模板</li>
                                <li><img src="http://easyii.cm/public/images/features-icon3.png" alt="" />mui金融行业app模板</li>
                                <li><img src="http://easyii.cm/public/images/features-icon4.png" alt="" />灰色简单的金融网站模板下载</li>
                                <li><img src="http://easyii.cm/public/images/features-icon5.png" alt="" />EduSoho开源网络课堂系统官网模板</li>
                                <li><img src="http://easyii.cm/public/images/features-icon6.png" alt="" />投票任务平台手机版</li>
                                <li><img src="http://easyii.cm/public/images/features-icon7.png" alt="" />html5国外响应式餐厅模板</li>
                            </ul>
                        </div>
                    </div><!-- end section -->

                    <div class="one_third">
                        <div class="white_bobox2">
                            <ul class="chooseus_list">
                                <li>html5国外响应式餐厅模板</li>
                                <li>EduSoho开源网络课堂系统官网模板</li>
                                <li>灰色简单的金融网站模板下载</li>
                                <li>flatty红色大气的管理系统模板</li>
                                <li>精仿苏宁电器商城网站模板</li>
                                <li>投票任务平台手机版</li>
                                <li>mui金融行业app模板</li>
                            </ul>
                        </div>
                    </div>

                    <div class="one_third last">
                        <div class="white_bobox3">
                            <img src="http://easyii.cm/public/images/site-img-02.jpg" alt="" class="img_left01" /> <h4><i>Web site</i> Hosting</h4>
                        </div>
                        <div class="clearfix mar_top1"></div>
                        <div class="white_bobox3">
                            <img src="http://easyii.cm/public/images/site-img-03.jpg" alt="" class="img_left01" /> <h4><i>Domain Name</i> Registration</h4>
                        </div>
                        <div class="clearfix mar_top1"></div>
                        <div class="white_bobox3">
                            <img src="http://easyii.cm/public/images/site-img-04.jpg" alt="" class="img_left01" /> <h4><i>Web Design</i> &amp; development</h4>
                        </div>
                    </div>

                </div>
                <div class="footersection_two">

                    <div class="container">

                        <div class="one_half">

                            <div class="newsletter">

                                <img src="http://easyii.cm/public/images/newsletter-icon.png" alt="" class="img_left01" />

                                <h4>Newsletter Sign up</h4>

                                <form method="get" action="index.html">
                                    <input class="enter_email_input" name="samplees" id="samplees" value="Enter your email address" onFocus="if(this.value == 'Enter your email address') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Enter your email address';}" type="text">
                                    <input name="" value="subscribe" class="input_submit" type="submit">
                                </form>
                            </div>

                        </div><!-- end newsletter sign up -->

                        <div class="one_half last">

                            <div class="payments_accept">

                                <h4>Payments We accept</h4>

                                <ul class="paymetns_logos">
                                    <li><img src="http://easyii.cm/public/images/payments-logo1.png" alt="" /></li>
                                    <li><img src="http://easyii.cm/public/images/payments-logo2.png" alt="" /></li>
                                    <li><img src="http://easyii.cm/public/images/payments-logo3.png" alt="" /></li>
                                    <li><img src="http://easyii.cm/public/images/payments-logo4.png" alt="" /></li>
                                    <li><img src="http://easyii.cm/public/images/payments-logo5.png" alt="" /></li>
                                    <li><img src="http://easyii.cm/public/images/payments-logo6.png" alt="" /></li>
                                </ul>

                            </div>

                        </div><!-- end payments we accept -->

                    </div>

                </div>
            </div>
        </div>
        <!--end footer-->
        <!-- start copyright info -->
        <div class="copyright_info">

            <div class="container">

                <div class="one_half">Copyright © 2013 Airo Hosting.com. More Templates<a href="http://www.mycodes.net/" target="_blank">源码之家</a></div>

                <div class="one_half last"><span><a href="#">Terms of Service</a> | <a href="#">Privacy Policy</a></span></div>

            </div>

        </div>
        <!-- end copyright info -->
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>