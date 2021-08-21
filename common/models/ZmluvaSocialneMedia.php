<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class ZmluvaSocialneMedia extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zmluva_socialne_media';
    }

    /**
     * @param array $data
     * @throws yii\db\Exception
     */
    public function pridajSocialneMedia(array $data)
    {
        if (!isset($data['social_media']) || count($data['social_media']) == 0) {
            return;
        }

        $rows = [];

        foreach ($data['social_media'] as $media) {
            $rows[] = "(null, {$data['zmluva_id']}, '{$media}', 1)";
        }

        $sql = "insert into zmluva_socialne_media values %s";
        $items = implode(",",$rows);
        $sql = sprintf($sql, $items);

        $result = Yii::$app->db->createCommand($sql)->execute();

        if (!$result) {
            throw new Exception('Nemozem ulozit info o zdielani', 401);
        }
    }

}