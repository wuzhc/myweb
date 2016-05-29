<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/29
 * Time: 19:58
 */

namespace common\behavior;


use common\models\ArticleContent;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class ArticleBehavior extends Behavior
{

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'saveContent',
            ActiveRecord::EVENT_BEFORE_INSERT => 'saveAuthor',
            ActiveRecord::EVENT_AFTER_UPDATE => 'saveContent',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'saveAuthor',
        ];
    }

    public function saveAuthor()
    {
        $this->owner->user_id = Yii::$app->user->id;
    }

    public function saveContent()
    {
        $content = ArticleContent::findModel(['article_id' => $this->owner->id]);
        $content->article_id = $this->owner->id;
        $content->content = $this->owner->content;
        $content->save();
    }
    
}