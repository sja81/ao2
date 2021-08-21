<?php
namespace common\models;

use Yii;
use common\entities\ContractEntity;
use common\helpers\DateHelper;
use yii\base\Exception;

final class Contract
{
    private $userId = null;
    private $id = null;
    private $contractNumber=null;


    public function setId(int $id)
    {
        $this->id=$id;
        return $this;
    }

    public function setContractNumber($number)
    {
        $this->contractNumber = $number;
        return $this;
    }


    /**
     * @param int $id
     * @return $this
     */
    public function setUserId(int $id): ?self
    {
        $this->userId = $id;
        return $this;
    }

    /**
     * @param $params
     * @return int
     * @throws Exception
     */
    public function saveNewContract($params)
    {
        $entity = new ContractEntity();
        $entity->created_at = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $entity->created_by = !is_null($this->userId) ? $this->userId : Yii::$app->user->identity->id;
        $entity->number = $params['contract_number'];
        $entity->status = ContractEntity::PENDING;
        $entity->save();
        if (!$entity) {
            throw new Exception("Nebola vytvorena zmluva!!!",404);
        }
        $this->id = $entity->id;
        unset($entity);
        return $this;
    }


    public function getContractDetails($id)
    {
        $contract = Yii::$app->db->createCommand("select * from contract where id=:id")->bindValue(':id',$id)->queryOne();
        if( !$contract ) {
            throw new \Exception("Nenasiel som zmluvu s cislom: {$id}",404);
        }

        return $contract;
    }

    public function updateContractStatus(int $id, int $status)
    {
        Yii::$app->db->createCommand("UPDATE contract SET status=:status WHERE id=:id")->bindValues([
            ':status' => $status,
            ':id' => $id
        ])->execute();
    }


    public function getId()
    {
        return $this->id;
    }

    public function saveOtherInfo(array $data)
    {
        $toSkip = [
            'share',
            'contract_id'
        ];
        $contract = ContractEntity::findOne(['id'=>$this->id]);

        foreach($data as $key=>$value) {

            if (in_array($key, $toSkip)) {
                continue;
            }
            $contract->$key = $value;

            $result = $contract->save();

            if(!$result) {
                throw new Exception('Nastala sa chyba pri ukladani contract', 404);
            }
        }

        return $this;
    }

    public function saveShareInfo(array $data)
    {
        Yii::$app->db->createCommand("update contract_social_media set status=0 where contract_id=:id")->bindValue(':id',$this->id)->execute();
        $sql = "insert into contract_social_media values %s";
        $items = [];
        foreach($data['share'] as $item) {
            $items[] = "(null, {$this->id}, '{$item}', 1)";
        }
        $sql = sprintf($sql, implode(",",$items));
        Yii::$app->db->createCommand($sql)->execute();

        return $this;
    }

    public function saveSummaryDescription($summary='',$description='')
    {
        $propertyId = Yii::$app->db->createCommand("select property_id from contract_property where contract_id=:id")->bindValue(':id', $this->id)->queryScalar();

        if (!$propertyId) {
           throw new \Exception("Property was not found for the contract");
        }

        $sql = sprintf(
            "insert into property_summary values (null, %d, '%s', '%s')",
             $propertyId,
             trim($summary),
             trim($description)
        );

        Yii::$app->db->createCommand($sql)->execute();

        return $this;
    }


}