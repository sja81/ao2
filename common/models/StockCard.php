<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class StockCard extends ActiveRecord
{
    public static function tableName()
    {
        return 'skladova_karta';
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'kod' => 'Kod',
            'nazov' => 'Nazov',
            'expiracia' => 'Expiracia',
            'dodavatel1' => 'Dodavatel 1',
            'dodane1' => 'Dodane 1',
            'dodavatel1_url' => 'Dodavatel 1 URL',
            'dodavatel1_poznamka' => 'Dodavatel 1 Poznamka',
            'cena1' => 'Cena 1',
            'dodavatel2' => 'Dodavatel 2',
            'status' => 'Status',
            'dodane2' => 'Dodane 2',
            'dodavatel2_url' => 'Dodavatel 2 URL',
            'cena2' => 'Cena 2',
            'dodavatel2_poznamka' => 'Dodavatel 2 Poznamka',
            'interna_poznamka' => 'Interna poznamka',
            'dodavatel3' => 'Dodavatel 3',
            'pouzitelnost' => 'Pouzitelnost',
            'dodane3' => 'Dodane 3',
            'dodavetel3_url' => 'Dodavatel 3 URL',
            'dodavatel3_poznamka' => 'Dodavatel 3 Poznamka',
            'cena3' => 'Cena 3',
            'vyrobca' => 'Vyrobca',
            'vyrobene' => 'Vyrobene',
            'vyrobca_url' => 'Vyrobca URL',
            'vyrobca_poznamka' => 'Vyrobca poznamka',
            'na_sklade' => 'Na sklade',
            'merna_jednotka' => 'Merna jednotka',
            'min_koncentracia' => 'Min. koncentracia',
            'max_koncentracia' => 'Max. koncentracia',
            'pomer_ried_voda' => 'Pomer riedenia - voda',
            'pomer_ried_latka' => 'Pomer riedenia - latka',
            'datasheet' => 'Datasheet',
        ];
    }

    public function rules()
    {
        return [
            [
                [
                    'kod',
                    'nazov',
                    'expiracia',
                    'dodavatel1',
                    'dodane1',
                    'dodavatel1_url',
                    'dodavatel1_poznamka',
                    'cena1',
                    'dodavatel2',
                    'status',
                    'dodane2',
                    'dodavatel2_url',
                    'cena2',
                    'dodavatel2_poznamka',
                    'interna_poznamka',
                    'dodavatel3',
                    'pouzitelnost',
                    'dodane3',
                    'dodavetel3_url',
                    'dodavatel3_poznamka',
                    'cena3',
                    'vyrobca',
                    'vyrobene',
                    'vyrobca_url',
                    'vyrobca_poznamka',
                    'na_sklade',
                    'merna_jednotka',
                    'min_koncentracia',
                    'max_koncentracia',
                    'pomer_ried_voda',
                    'pomer_ried_latka',
                ],
                'safe'
            ],
        ];
    }

    public function statusText()
    {
        $stats = [
            '0' => Yii::t('app','Vyradené'),
            '1' => Yii::t('app','Dočasne nedostupný'),
            '2' => Yii::t('app','Dostupný'),
        ];
        return $stats[$this->status];
    }
}