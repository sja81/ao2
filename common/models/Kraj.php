<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Kraj  extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kraj';
    }

    public static function krajePreVyhladanie()
    {
        $sql = "SELECT
                   GROUP_CONCAT(\"<optgroup label='\", r.name,\"' class='option-parent'>\",r.items,\"</optgroup>\" SEPARATOR '') AS vysledok
                FROM (
                    select
                        st.id,
                        st.`name`,
                        (select group_concat(\"<option value='\",kr.`name`,\"' class='option-child'>\",kr.`name`,\"</option>\" SEPARATOR \"\" ) from kraj kr where st.id=kr.country_id) as items
                    from
                        stat st
                    where
                        st.status=1
                ) AS r";
        return Yii::$app->db->createCommand($sql)->queryScalar();
    }
}