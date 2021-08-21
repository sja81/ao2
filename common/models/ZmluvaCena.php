<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class ZmluvaCena extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zmluva';
    }

    /**
     * @param array $data
     * @throws yii\db\Exception
     */
    public function pridajCeny(array $data)
    {
        $sql = "insert into zmluva_cena values %s";
        $rows = [];

        if ($data['kupna_cena'] != '0') {
            $cena = explode(",",$data['kupna_cena']);
            $provizia = explode(",", $data['predaj_provizia']);
            $zlava = $data['predaj_zlava'] =='' ? 0.00 :$data['predaj_zlava'];

            for($i=0;$i<count($cena);$i++) {
                $rows[] = "(null, {$data['zmluva_id']}, 'PREDAJ', {$data['predaj_percento']}, ". str_replace(" ","",trim($provizia[$i])) . ",'{$data['predaj_provizia_typ']}', ". str_replace(" ","",trim($cena[$i])) . ", 1, {$zlava},null)";
            }
        }
        if ($data['prenajom_cena'] != '0') {
            $cena = explode(",",$data['prenajom_cena']);
            $provizia = explode(",", $data['prenajom_provizia']);
            $zlava = $data['prenajom_zlava'] == '' ? 0.00 : $data['prenajom_zlava'];

            for($i=0;$i<count($cena);$i++) {
                $rows[] = "(null, {$data['zmluva_id']}, 'PRENAJOM', 0, ". str_replace(" ","",trim($provizia[$i])) . ",'', ". str_replace(" ","",trim($cena[$i])) . ", 1, {$zlava},null)";
            }
        }
        if ($data['ine_cena'] != '0') {
            $cena = explode(",",$data['ine_cena']);
            $provizia = explode(",", $data['ine_provizia']);

            for($i=0;$i<count($cena);$i++) {
                $rows[] = "(null, {$data['zmluva_id']}, 'PREDAJ', {$data['ine_percento']}, ". str_replace(" ","",trim($provizia[$i])) . ",'{$data['ine_provizia_typ']}', ". str_replace(" ","",trim($cena[$i])) . ", 1, 0.00,'{$data['c_text']}')";
            }
        }

        $items = implode(",",$rows);
        $sql = sprintf($sql, $items);
        $result = Yii::$app->db->createCommand($sql)->execute();

        if (!$result) {
            throw new Exception('Nemozem ulozit informaciu o cenach', 401);
        }
    }

    public static function vratCenu(int $id)
    {
        $sql = "SELECT cena FROM zmluva_cena WHERE zmluva_id={$id}";

        return Yii::$app->db->createCommand($sql)->queryScalar();
    }
}