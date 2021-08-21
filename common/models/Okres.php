<?php
namespace common\models;


use Yii;
use yii\db\ActiveRecord;

class Okres extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'okres';
    }

    public static function okresyPreVyhladanie()
    {
        $return = [];
        $sql = "select o.id, o.name, o.region_id from okres o where status=1";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        $tmp = [];
        foreach ($result as $item) {
            $tmp[$item['region_id']][] = "<option value='{$item['name']}' class='option-child'>{$item['name']}</option>";
        }
        unset($result);
        foreach ($tmp as $id=>$item) {
            $nazov = Yii::$app->db->createCommand("select `name` from kraj where id={$id}")->queryScalar();
            $return[] = sprintf("<optgroup label='{$nazov}' class='option-parent'>%s</optgroup>", implode("",$item));
        }
        unset($tmp);
        return implode("", $return);
    }
}