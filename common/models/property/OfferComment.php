<?php
namespace common\models\property;

use yii\db\ActiveRecord;

class OfferComment extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'offerComment';
    }

}