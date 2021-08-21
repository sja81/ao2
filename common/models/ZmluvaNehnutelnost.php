<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class ZmluvaNehnutelnost extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zmluva_nehnut';
    }

    public function getNehnutelnost()
    {
        return $this->hasOne(Nehnutelnost::class,['id'=>'nehnut_id']);
    }

    public static function getNehnutelnostId($zmluvaId)
    {
        $sql = "select nehnut_id from zmluva_nehnut where zmluva_id=:id";
        return Yii::$app->db->createCommand($sql)->bindValue(':id',$zmluvaId, \PDO::PARAM_INT)->queryScalar();
    }
}