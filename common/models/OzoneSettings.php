<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class OzoneSettings extends ActiveRecord
{
    const CLIMATE_OUT = 'vonku';
    const CLIMATE_IN = 'vnutro';

    public static function tableName()
    {
        return 'ozone_settings';
    }


    /**
     * @param $code
     * @return array|false|\yii\db\DataReader
     * @throws \yii\db\Exception
     */
    private static function _GetValues($code)
    {
        return Yii::$app
            ->db
            ->createCommand("select field_value from ozone_settings where field_name=:fdname")
            ->bindValue(':fdname',$code)
            ->queryOne();
    }

    /**
     * @param $field
     * @param $code
     * @return float
     * @throws \yii\db\Exception
     */
    private static function _GetPrices($field, $code)
    {
        $price = 0;

        $result = Yii::$app->db->createCommand("select field_value from ozone_settings where field_name=:fdname")
            ->bindValue(':fdname',$field)
            ->queryOne();

        $result = json_decode($result['field_value'], true);
        foreach ($result as $item) {
            if ($item['code'] == $code) {
                $price = $item['price'];
                break;
            }
        }

        return (float)$price;
    }

    /**
     * @return float
     * @throws \yii\db\Exception
     */
    public static function getDefaultPrice()
    {
        return (float)(static::_GetValues('default_price'))['field_value'];
    }

    /**
     * @return mixed
     * @throws \yii\db\Exception
     */
    public static function getOdorLevel()
    {
        return json_decode(static::_GetValues('odor_level')['field_value'], true);
    }

    /**
     * @param $code
     * @return float
     * @throws \yii\db\Exception
     */
    public static function getVehiclePrice($code)
    {
        return (float)static::_GetPrices('vehicle_price', $code);
    }

    /**
     * @param $code
     * @return float
     * @throws \yii\db\Exception
     */
    public static function getClimatePrice($code)
    {
        return (float)static::_GetPrices('climate_price', $code);
    }

    /**
     * @return float
     * @throws \yii\db\Exception
     */
    public static function getMeasurmentPrice()
    {
        return (float)static::_GetValues('measurment_price')['field_value'];
    }

}