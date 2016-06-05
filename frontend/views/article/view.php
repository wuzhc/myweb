<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
$this->title = $content->title;
?>
<div class="container">
    <div class="content_fullwidth">
        <div class="one_full">
            <div class="big_text2" style="font-size: 18px; text-align: center; color: #0A0; font-weight: bold">
                <?= Html::encode($content->title) ?>
            </div>
            <br />
            <div>
            <?= $content->article->content ?>
            </div>
        </div><!-- end section -->
    </div>
    <div class="clearfix mar_top4"></div>
    <h4>评论</h4>
    <div class="mar_top_bottom_lines_small3"></div>
    <!--start comment-->
    <div class="comment_wrap">
        <div class="gravatar"><img src="/public/frontend/images/blog/people_img.jpg" alt="" /></div>
        <div class="comment_content">
            <div class="comment_meta">
                <div class="comment_author">游客 <i>2016-05-21</i></div>
            </div>
            <div class="comment_text">
                <p>写的这是什么几把玩意儿啊，我们都看不懂</p>
            </div>
        </div>
    </div>
    <!--end comment-->
    <!--start comment-->
    <div class="comment_wrap">
        <div class="gravatar"><img src="/public/frontend/images/blog/people_img.jpg" alt="" /></div>
        <div class="comment_content">
            <div class="comment_meta">
                <div class="comment_author">游客 <i>2016-05-21</i></div>
            </div>
            <div class="comment_text">
                <p>写的这是什么几把玩意儿啊，我们都看不懂</p>
            </div>
        </div>
    </div>
    <!--end comment-->
    <div class="comment_form">
        <h4>发表你内心的感受吧</h4>
        <?php $model = new \common\models\Content()?>
        <?= \common\widgets\SimditorWidget::widget(['model' => $model])?>

    </div><!-- end comment form -->
</div>
<div class="clearfix mar_top4"></div>


<div class="clearfix mar_top2"></div>