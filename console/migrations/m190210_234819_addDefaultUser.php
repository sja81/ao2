<?php

use yii\db\Migration;

/**
 * Class m190210_234819_addDefaultUser
 */
class m190210_234819_addDefaultUser extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = [
            "'null'",
            "'szabobalazs'",
            "''",
            "'".password_hash('Eladva123',PASSWORD_DEFAULT)."'",
            "''",
            "'sksja1981@gmail.com'",
            10,
            time(),
            "'null'"
        ];
        $user = implode(",",$user);
        Yii::$app->db->createCommand("INSERT INTO `user` VALUES ({$user})")->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190210_234819_addDefaultUser cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190210_234819_addDefaultUser cannot be reverted.\n";

        return false;
    }
    */
}
