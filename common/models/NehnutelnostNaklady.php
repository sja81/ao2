<?php
namespace common\models;

use yii\db\ActiveRecord;

class NehnutelnostNaklady extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nehnut_naklady';
    }

    public function ulozNaklady(array $data, $nehnutId)
    {
        foreach ($data as $key=>$value) {
            $this->$key = $value;
        }
        $this->nehnut_id = $nehnutId;

        return $this->save();
    }


}