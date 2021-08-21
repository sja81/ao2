<?php
namespace common\models;

use yii\db\ActiveRecord;

class NehnutelnostSumar extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nehnut_sumar';
    }

    /**
     * @param array $data
     * @param int $nehnutelnostId
     * @throws yii\db\Exception
     */
    public function pridajSumar(array $data, int $nehnutelnostId)
    {
        $this->nehnut_id = $nehnutelnostId;
        $this->summary = $data['summary'];
        $this->description = $data['description'];

        $result = $this->save();

        if (!$result) {
            throw new Exception("Nemozem ulozit popis k nehnutelnosti!", 401);
        }
    }
}