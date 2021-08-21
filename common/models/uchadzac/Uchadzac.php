<?php
namespace common\models\uchadzac;

use yii\db\ActiveRecord;

class Uchadzac extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uchadzac';
    }

    public function getFullName()
    {
        $name = [
            $this->first_name,
            $this->last_name
        ];
        $name = join(" ", $name);
        if (!is_null($this->acc_deg_before)) {
            $name = $this->acc_deg_before . " " . $name;
        }
        if (!is_null($this->acc_deg_after)) {
            $name .= ", {$this->acc_deg_after}";
        }
        return $name;
    }

    public function getFullAddress($delimiter="<br>")
    {
        $address = $this->street . $delimiter . $this->zip . " " . $this->town;
        if (!is_null($this->country)) {
            $address .= $delimiter . $this->country;
        }
        return $address;
    }

    public function getPozicia()
    {
        return $this->hasOne(UchadzacPozicia::class,['uchadzac_id'=>'id']);
    }

    public function getBirthDate($format='d.m.Y')
    {
        return (new \DateTime($this->born_date))->format($format);
    }

    public function getGenderText()
    {
        $result = \Yii::t('app','muž');
        if ($this->gender == 'f') {
            $result = \Yii::t('app','žena');
        }
        if ($this->gender == 'd') {
            $result = \Yii::t('app','iné');
        }
        return $result;
    }

    private function getDocumentRelation()
    {
        return $this->hasMany(UchadzacDoc::class, ['uchadzac_id'=>'id']);
    }

    public function getPicture()
    {
        $pics = $this
            ->getDocumentRelation()
            ->andWhere(['=','doc_type',UchadzacDoc::DOCTYPE_PHOTO])
            ->andWhere(['=', 'status', 1])
            ->asArray()
            ->one();
        return !$pics ? UchadzacDoc::NO_PICS : $pics['doc_dir'].'/'.$pics['doc'];
    }

    public function getTests()
    {
        return $this->hasOne(UchadzacTest::class,['uchadzac_id'=>'id']);
    }

}