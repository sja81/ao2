<?php
namespace common\widgets\traits;

use Yii;
use yii\helpers\Url;

trait GenTreeData
{
    public function genTreeData(int $parent): array
    {
        $result = [];
        $sql = "select id, concat(id,'_',category_name) as category, parent_id from template_category where parent_id={$parent} and status=1";
        $elems = Yii::$app->db->createCommand($sql)->queryAll();
        if (!$elems) {
            return [];
        }
        foreach($elems as $elem) {
            $result[$elem['category']] = $this->genTreeData($elem['id']);
        }
        return $result;
    }

    public function genTree(array $treeData, $defaultId = null)
    {
        $result = '';

        foreach($treeData as $key => $item) {
            list($id,$value) = explode('_',$key);
            $checked = !is_null($defaultId) && $defaultId == $id ? " checked" : "";
            if (!empty($item)) {
                $result .= "<li><input class='cat-item' type='checkbox'{$this->nameString} value='{$id}'{$this->classString}{$checked}>&nbsp;<span class='caret'>{$value}</span><ul class='nested'>";
                $result .= $this->genTree($item, $defaultId);
                $result .= "</ul></li>";
            } else {
                $result .= "<li><input class='cat-item' type='checkbox'{$this->nameString}  value='{$id}'{$this->classString}{$checked}>&nbsp;{$value}</li>";
            }
        }
        return $result;
    }

    public function genTreeWithFileList(array $treeData)
    {
        $result = '';

        foreach($treeData as $key => $item) {
            list($id,$value) = explode('_',$key);
            $fileList = $this->getFileList($id);
            $fileListCount = !empty($fileList) ? "&nbsp;<span>(" . count($fileList) . ")</span>" : "";
            if (!empty($item) || !empty($fileListCount)) {
                $result .= "<li class='item-{$id}' data-txt='{$value}'><span class='caret'>{$value}</span>{$fileListCount}<span class='cat-edit' onclick='editCategory({$id})'><i class='fas fa-edit'></i></span><ul class='nested'>";
                if (!empty($item)) {
                    $result .= $this->genTreeWithFileList($item);
                }
                if (!empty($fileListCount)) {
                    $result .= $this->listFiles($fileList);
                }
                $result .= "</ul></li>";
            } else {
                $result .= "<li class='item-{$id}' data-txt='{$value}'>{$value}{$fileListCount}<span class='cat-edit' onclick='editCategory({$id})'><i class='fas fa-edit'></i></span></li>";
            }
        }
        return $result;
    }

    protected function getFileList($categoryId)
    {
        $sql = "select * from template where category_id={$categoryId}";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    protected function listFiles($files)
    {
        $result = '';
        foreach($files as $item) {
            $result .= "<li><i class='fas fa-file-pdf pdf'></i>&nbsp;{$item['name']} ";
            $result .= "<a href='".Url::to(['/documents/edit','id'=>$item['id']])."' class='doc-edit'><i class='fas fa-edit'></i></a>";
            $result .= "<span class='doc-view' onclick='viewTemplate({$item['id']})'><i class='fas fa-eye'></i></span>";
            $result .= "<span class='doc-delete' onclick='deleteTemplate({$item['id']})'><i class='fas fa-trash-alt'></i></>";
            $result .= "</li>";
        }
        return $result;
    }
}