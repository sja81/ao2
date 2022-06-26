<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Stat extends ActiveRecord
{
    const SLOVAKIA = 1;
    const UKRAINE = 24;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stat';
    }
	
	public static function getPredvolby()
	{
		$sql = "SELECT predvolba FROM stat WHERE `status`=1";
		return Yii::$app->db->createCommand($sql)->queryAll();
	}

	public static function getStaty()
    {
        $sql = "SELECT id, name from stat where status=1";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * @return array
     * @throws \yii\db\Exception
     */
    public function getCountries(): array
    {
        $sql = "SELECT id, international_name from stat where status=1";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * @return array
     */
    public function getPrefixes(): array
    {
        $sql = "SELECT iso_kod, predvolba FROM stat WHERE `status`=1";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }
}