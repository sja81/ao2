<?php
namespace common\models\auth;

class AuthAssignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * @param int $userId
     * @return string
     */
    public function getGroupsByUserId(int $userId): string
    {
        $group = self::find()->select(['item_name'])->where(['=','user_id',$userId])->asArray()->all();
        if (is_null($group)) {
            return '';
        }

        $groups = [];
        array_walk($group, function($value, $key) use (&$groups) {
            $groups[] = $value['item_name'];
        });

        return implode(',', $groups);
    }
}