<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Customer extends ActiveRecord
{

    const PREDAJCA = 1;
    const KUPUJUCI = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    public function getCompany()
    {
        return $this->hasOne(CustomerCompany::class,['customer_id'=>'id']);
    }


    public function pridajZakaznika(array $data=[])
    {
        foreach($data as $key=>$value) {
            if (in_array($key,['predvolba','UTO','cislo'])) {
                continue;
            }
            if (in_array($key,['obchodne_meno','ico','dic','icdph'])) {
                continue;
            }
            $this->$key = $value;
        }
        $this->phone = "{$data['predvolba']},{$data['UTO']},{$data['cislo']}";
        $this->no_email=0;
        $this->no_newsletter=0;
        $this->status=1;
        $this->created_by = Yii::$app->user->identity->id;
        $result = $this->save();

        if (!$result) {
            throw new \Exception("Neviem ulozit zakaznika", 401);
        }
    }

    public function pripojZakaznikaKuZmluve(int $contractId)
    {
        $sql = "
            INSERT INTO zmluva_zakaznik VALUES (null, :cid, :custid, 1)
        ";
        Yii::$app->db->createCommand($sql)->bindValues([
            ':cid'  => $contractId,
            ':custid'   =>  $this->id
        ])->execute();

    }

    public function vratZoznam(int $page=1)
    {
        return Yii::$app->db->createCommand("
            SELECT 
                c.name_first, c.name_last, m.nazov_obce, c.rodne_cislo, c.phone, c.email
            FROM
                customer c 
            JOIN
                mesto m ON c.town_id = m.id
        ")->queryAll();
    }


}