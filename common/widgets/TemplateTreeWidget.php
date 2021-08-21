<?php
namespace common\widgets;

use common\widgets\traits\GenTreeData;
use yii\base\Widget;
use Yii;

class TemplateTreeWidget extends Widget
{
    use GenTreeData;

    const ROOT_PARENT_ID = 0;

    public $id = null;
    public $name = null;
    public $class_id = null;

    private $classString = '';
    private $nameString = '';

    public function init()
    {
        parent::init();
        if (is_null($this->id)) {
            $this->id =  'TemplateCategoryTreeWidget-'. uniqid();
        }
        if (!is_null($this->class_id)){
            $this->classString = " class='{$this->class_id}'";
        }
        if (!is_null($this->name)) {
            $this->nameString = " name='{$this->name}[category_id]'";
        }
    }

    public function run()
    {
        $treeData = $this->genTreeData(self::ROOT_PARENT_ID);
        $tree = $this->genTreeWithFileList($treeData);
        return $this->render('templatetreewidget/index',[
            'id'   => $this->id,
            'name'  => $this->name,
            'tree'  => $tree
        ]);
    }
}