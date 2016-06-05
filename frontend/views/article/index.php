<?php
use common\helper\ImageHelper;
use yii\helpers\Html;
use yii\widgets\ListView;
$this->title = '吴桢灿';
?>
<div class="container">
    <!-- start content left area -->
    <div class="content_left">
        <!--start blog_post-->
        <?= ListView::widget([
            'summary' => '',
            'dataProvider' => $dataProvider,
            'itemView' => '_article_list',
            'emptyText' => Html::img(\common\config\Conf::EMPTY_DATA),
        ])?>
        <!--end blog_post-->
    </div>
    <!-- end content left area -->

    <!-- right sidebar starts -->
    <div class="right_sidebar">
        <!-- start site search -->
        <div class="site-search-area">
            <form method="get" id="site-searchform" action="blog.html">
                <div>
                    <input class="input-text" name="s" id="s" value="搜索" onFocus="if (this.value == '搜索') {this.value = '';}" onBlur="if (this.value == '') {this.value = '搜索';}" type="text" />
                    <input id="searchsubmit" value="Search" type="submit" />
                </div>
            </form>
        </div>
        <!-- end site search -->
        <div class="clearfix mar_top3"></div>
        <!--start categories-->
        <div class="sidebar_widget">
            <div class="sidebar_title"><h3>类别</h3></div>
            <ul class="arrows_list1">
                <li><a href="#">技术文档</a></li>
                <li><a href="#">开源代码</a></li>
                <li><a href="#">开发利器</a></li>
                <li><a href="#">资源下载</a></li>
                <li><a href="#">技术讨论</a></li>
            </ul>
        </div>
        <!--end categories-->
        <div class="clearfix mar_top3"></div>
        <!--start recent posts-->
        <div class="sidebar_widget">
            <div class="sidebar_title"><h3>最新博客</h3></div>
            <ul class="recent_posts_list">
                <li>
                    <span><a href="#"><img src="http://easyii.cm/public/images/site-img-04.jpg" alt="" /></a></span>
                    <a href="#">tp框架中有个接受所有post过来的函数是哪个</a>
                    <i>2016-05-21</i>
                </li>
                <li>
                    <span><a href="#"><img src="http://easyii.cm/public/images/site-img-04.jpg" alt="" /></a></span>
                    <a href="#">tp框架中有个接受所有post过来的函数是哪个</a>
                    <i>2016-05-21</i>
                </li>
                <li>
                    <span><a href="#"><img src="http://easyii.cm/public/images/site-img-04.jpg" alt="" /></a></span>
                    <a href="#">tp框架中有个接受所有post过来的函数是哪个</a>
                    <i>2016-05-21</i>
                </li>
            </ul>
        </div>
        <!--end recent posts-->
        <div class="clearfix mar_top3"></div>
        <div class="sidebar_widget">
            <h3>活跃成员</h3>
            <ul class="adsbanner-list">
                <li><a href="#"><img src="http://easyii.cm/public/images/blog/people_img.jpg" alt="" /></a></li>
                <li class="last"><a href="#"><img src="http://easyii.cm/public/images/blog/people_img.jpg" alt="" /></a></li>
                <li><a href="#"><img src="http://easyii.cm/public/images/blog/people_img.jpg" alt="" /></a></li>
                <li class="last"><a href="#"><img src="http://easyii.cm/public/images/blog/people_img.jpg" alt="" /></a></li>
            </ul>
        </div><!-- end section -->
        <div class="clearfix mar_top3"></div>
        <div class="sidebar_widget">
            <h3>更多内容</h3>
            <ul class="arrows_list1">
                <li><a href="#">2016-08</a></li>
                <li><a href="#">2016-07</a></li>
                <li><a href="#">2016-06</a></li>
                <li><a href="#">2016-05</a></li>
                <li><a href="#">2016-04</a></li>
            </ul>
        </div><!-- end section -->
        <div class="clearfix mar_top3"></div>
        <div class="sidebar_widget">
            <div class="sidebar_title"><h3>PHP简介</h3></div>
            <p>
                &nbsp;&nbsp;PHP，一个嵌套的缩写名称，是英文超级文本预处理语言（PHP:Hypertext Preprocessor）的缩写。PHP 是一种 HTML 内嵌式的语言，PHP与微软的ASP颇有几分相似，都是一种在服务器端执行的嵌入HTML文档的脚本语言，语言的风格有类似于C语言，现在被很多的网站编程人员广泛的运用。
            </p>
            <p>
                &nbsp;&nbsp;PHP 独特的语法混合了C、Java、Perl 以及 PHP 自创新的语法。它可以比 CGI 或者 Perl 更快速的执行动态网页。
            </p>
        </div>

    </div><!-- end right sidebar -->


</div>