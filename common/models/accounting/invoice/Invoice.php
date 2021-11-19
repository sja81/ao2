<?php
namespace common\models\accounting\invoice;

use Yii;

class Invoice extends \yii\db\ActiveRecord
{
    const PENDING = 1;
    const PAID = 2;
    const DELETED = 3;

    public static function tableName(): string
    {
        return 'invoice';
    }

    public function attributeLabels(): array
    {
        return [
            'id'    => 'ID',
            'status' => Yii::t('app','Status'),
            'invoicingYear' => Yii::t('app','Rok'),
            'invoicingMonth' => Yii::t('app','Mesiac')
        ];
    }


}