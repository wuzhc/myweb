<?php

namespace common\behavior;


use common\service\CategoryService;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class CategoryBehavior extends Behavior
{

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'savePathAndLevel',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'savePathAndLevel',
        ];
    }

    public function savePathAndLevel($event)
    {
        $this->owner->path = $this->parentPath . '-' . $this->owner->parent;
        $this->owner->level = substr_count($this->owner->path, '-');
    }

    public function getParentPath()
    {
        return CategoryService::factory()->getParentPath($this->owner->parent);
    }
}