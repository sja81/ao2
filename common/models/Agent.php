<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Agent extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'agent';
    }

    public static function getAgent(int $id)
    {
        $sql = "SELECT
                    a.id,
                    CONCAT(a.name_first, ' ', a.name_last) AS agent_name,
                    p.id AS comission
                FROM
                    agent a
                JOIN
                    `user` u ON u.id=a.user_id
                JOIN
                    provizia p ON a.comission=p.id
                WHERE
                    u.`status`= :stat and a.user_id=:uid";
        return Yii::$app->db->createCommand($sql)->bindValues([
            ':stat' => User::STATUS_ACTIVE,
            ':uid'  => $id
        ])->queryAll();
    }

    public static function getAllActiveAgents()
    {
        $sql = "SELECT
                    a.id,
                    CONCAT(a.name_first, ' ', a.name_last) AS agent_name,
                    p.id AS comission,
                    a.user_id
                FROM
                    agent a
                JOIN
                    `user` u ON u.id=a.user_id
                JOIN
                    provizia p ON a.comission=p.id
                WHERE
                    u.`status`= :stat";
        return Yii::$app->db->createCommand($sql)->bindValue(':stat', User::STATUS_ACTIVE, \PDO::PARAM_INT)->queryAll();
    }

    public function getActiveAgents(bool $returnAsArray=true)
    {
        $agents = self::find()
            ->select(['agent.id','concat(agent.name_first," ",agent.name_last) as meno'])
            ->innerJoin('user','user.id=agent.user_id')
            ->andWhere(['=','status',User::STATUS_ACTIVE]);
        if ($returnAsArray) {
            $agents->asArray();
        }
        return $agents->all();
    }

    public function getActiveAgentsByOffice(int $officeId = 1, bool $returnAsArray=true)
    {
        $agents = self::find()
            ->select(['agent.id','concat(agent.name_first," ",agent.name_last) as meno'])
            ->innerJoin('user','user.id=agent.user_id')
            ->andWhere(['=', 'status', User::STATUS_ACTIVE])
            ->andWhere(['=', 'office_id', $officeId]);
        if ($returnAsArray) {
            $agents->asArray();
        }
        return $agents->all();
    }

    public function getAgentByContractId(int $id)
    {
        $sql = "
            select * from contract_agent where contract_id=:id
        ";

        $agent = Yii::$app->db->createCommand($sql)->bindValue(':id',$id)->queryOne();

        if (!$agent) {
            throw new \Exception("Nenasiel som agenta pre tuto zmluvu",404);
        }

        return $agent;
    }

    public function isBusinessOwner()
    {
        return $this->owner == 1 ? true : false;
    }

    public function getFullAddress(): string
    {
        $address = [];
        if (!is_null($this->address1)) {
            $address[] = $this->address1;
        }
        if (!is_null($this->address2)) {
            $address[] = $this->address2;
        }
        return implode(',',$address);
    }

    public function getFullName(): string
    {
        return $this->name_first . ' ' . $this->name_last;
    }

}