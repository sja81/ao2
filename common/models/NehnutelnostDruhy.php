<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class NehnutelnostDruhy extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nehnut_druh';
    }

    public static function getDruhy(int $kategoriaId)
    {

        $sql = "select
                    ifnull((select nazov from nehnut_subkategoria where id = r.subkategoria limit 1),'') as subkategoria, 
                    group_concat(r.kategoria SEPARATOR '') as kategoria
                from
                    (
                        select 
                            concat('<option value=',id,'>',nazov,'</option>') as kategoria, 
                            ifnull(subkategoria_id,0) as subkategoria
                        from 
                            nehnut_druh 
                        where 
                            kategoria_id=:catid and status=1 
                
                    ) as r
                group by 
                    r.subkategoria";

        $ret = Yii::$app->db->createCommand($sql)->bindValue(':catid', $kategoriaId)->queryAll();


        $result = [];

        foreach($ret as $value) {
            if ($value['subkategoria'] != '') {
                $result[] = "<optgroup label='{$value['subkategoria']}'>{$value['kategoria']}</optgroup>";
            } else {
                $result[] = $value['kategoria'];
            }
        }

        return implode("",$result);

    }

    public static function druhyDoVyhladavania()
    {
        $return = [];
        $sql = "SELECT nd.id, nd.kategoria_id, nd.nazov FROM nehnut_druh nd WHERE `status`=1";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        $tmp = [];

        foreach ($result as $item) {
            $tmp[$item['kategoria_id']][] = "<option value={$item['id']} class='option-child'>{$item['nazov']}</option>";
        }

        unset($result);

        foreach ($tmp as $id=>$item) {
            $nazov = Yii::$app->db->createCommand("SELECT nazov FROM nehnut_kategoria WHERE id={$id}")->queryScalar();
            $return[] = "<option value='k-{$id}' class='option-parent'>{$nazov}</option>" . implode("",$item);
        }

        unset($tmp);

        return implode("", $return);
    }

    public static function vratNazov(int $id = null)
    {
        if (is_null($id)) {
            return "";
        }
        $sql = "SELECT
                    nd.nazov
                FROM 
                    nehnutelnost n
                JOIN
                    nehnut_druh nd ON n.druh_nehnut = nd.id
                WHERE
                    n.id={$id}";
        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

}