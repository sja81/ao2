<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Stat extends ActiveRecord
{
    const SLOVAKIA = 1;
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
}