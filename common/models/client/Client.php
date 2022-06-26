<?php
namespace common\models\client;

use yii\db\ActiveRecord;
use common\models\client\ClientBusiness;

class Client extends ActiveRecord
{
    const CLASS_SALT = 'xAOy0(N$/2:Ji3`Ab(93+|p6~s26|4Vf|0DD_[Vz^0#QL }J#*zx5}*73052|~|/';

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'client';
    }

    public function updateAuthKey()
    {
        $this->auth_key = hash('md5',$this->email.self::CLASS_SALT);
        $this->update(false);
    }

    public function makeReferalCode()
    {
        $referalCode = "TIP";
        $birthDay = (new \DateTime($this->birth_date));

        $referalCode .= strtoupper($this->name_first);
        $referalCode .= strtoupper($this->name_last);
        $referalCode .= $birthDay->format('m');
        $referalCode .= $birthDay->format('d');

        $this->referal_code = $referalCode;
        $this->save();
    }

    public static function getClientMainFolder(int $clientId)
    {
        return 'clients/' . str_pad($clientId,10, "0");
    }

    public static function getClientDocumentFolder(int $clientId)
    {
        return static::getClientMainFolder($clientId) . "/document";
    }
   
    public function getClientContact() 
    {
        return $this->hasOne(ClientContact::class, ['client_id' => 'id']);
    }

    public function getClientBusinesses() 
    {
        return $this->hasMany(ClientBusiness::class, ['client_id' => 'id']);
    }

    public function getClientDetail() 
    {
        return $this->hasOne(ClientDetail::class, ['client_id' => 'id']);
    }

    public function getDocuments() 
    {
        return $this->hasMany(ClientDocuments::class, ['client_id' => 'id']);
    }
}