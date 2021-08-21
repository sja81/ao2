<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Stock extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'sklad';
    }

    /**
     * @return array|string[]
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'kod' => 'Kod',
            'material_id'   => 'Material',
            'dodavatel_id' => 'Dodavatel',
            'vyrobene'  => 'Vyrobene',
            'expiracia' => 'Expiracia',
            'dodane' => 'Dodane',
            'url' => 'Url',
            'merna_jednotka' => 'Merna jednotka',
            'cena_za_jednotku' => 'Cena za jedn.',
            'mnozstvo' => 'Mnozstvo',
            'cena' => 'Cena',
            'poznamka' => 'Poznamka',
            'status' => 'Status'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDodavatel()
    {
        return $this->hasOne(MaterialDodavatel::class,['id'=>'dodavatel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::class, ['id'=>'material_id']);
    }

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [
                [
                    'kod',
                    'vyrobene',
                    'expiracia',
                    'dodane',
                    'url',
                    'merna_jednotka',
                    'cena_za_jednotku',
                    'mnozstvo',
                    'cena',
                    'poznamka',
                    'status'
                ],
                'safe'
            ],
        ];
    }

    /**
     * @return string
     */
    public function statusText()
    {
        $stats = [
            '0' => Yii::t('app','Vyradené'),
            '1' => Yii::t('app','Dočasne nedostupný'),
            '2' => Yii::t('app','Dostupný'),
        ];
        return $stats[$this->status];
    }

    public function mernaJednotkaText()
    {
        $texty = [
            "l" => 'liter',
            "ml" => 'mililiter',
            'g' => 'gram',
            'mg' => 'miligram',
            'kg' => 'kilogram'
        ];
        return $texty[$this->merna_jednotka];
    }
}