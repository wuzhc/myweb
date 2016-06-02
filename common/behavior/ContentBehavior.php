<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/29
 * Time: 19:58
 */

namespace common\behavior;


use common\helper\DebugHelper;
use common\models\ArticleContent;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class ContentBehavior extends Behavior
{
    public $contentModel;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'saveAuthor',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'saveAuthor',
        ];
    }

    public function saveAuthor()
    {
        $this->owner->user_id = Yii::$app->user->id;
    }

}