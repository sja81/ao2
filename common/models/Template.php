<?php
namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Template extends ActiveRecord
{
    public static function tableName()
    {
        return 'template';
    }

    public function getTemplateDetails(): ActiveQuery
    {
        return $this->hasMany(TemplateCategory::class, ['id'=>'category_id']);
    }

    public function getFullCategoryPaths(): array
    {
        $categories = $this->getTemplateDetails()->all();
        $paths = [];
        foreach ($categories as $category) {
            $paths[] = $category->getFullCategoryPath();
        }
        return $paths;
    }

}