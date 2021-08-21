<?php
namespace common\models;

class Cms
{
    public function getTopMenu()
    {
        $result = Post::find()
            ->where("post_parent=0 and post_status='published'")
            ->orderBy('menu_order ASC')
            ->asArray()
            ->all();

        foreach($result as &$it) {
            $result2 = Post::find()
                ->where("post_parent={$it['id']} and post_status='published'")
                ->orderBy('menu_order ASC')
                ->asArray()
                ->all();
            if (is_array($result2) && count($result2)>0) {
                $it['submenu']  = $result2;
            }
        }

        return $result;
    }

}