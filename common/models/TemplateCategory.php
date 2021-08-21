<?php
namespace common\models;

use yii\db\ActiveRecord;
use Yii;

class TemplateCategory extends ActiveRecord
{
    public static function tableName()
    {
        return 'template_category';
    }

    private function getParentId(int $id, &$categoryName) : int
    {
        $category = self::findOne(['id'=>$id]);
        if (!$category) {
            throw new Exception('The chosen category does not exists!');
        }
        $categoryName = $category->category_name;
        return $category->parent_id;
    }

    public function getTree()
    {
        return $this->genTreeData(0);
    }

}