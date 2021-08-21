<?php
namespace common\models\uchadzac;

use yii\db\ActiveRecord;

class UchadzacVzdelanie extends ActiveRecord
{
    const ZAKLADNE = 1;
    const STUDENT_STREDNEJ_SKOLY = 2;
    const STREDOSKOLSKE_BEZ_MATURITY = 3;
    const STREDOSKOLSKE_S_MATURITOU = 4;
    const NADSTAVBA = 5;
    const STUDENT_VS = 6;
    const VYS_1_ST = 7;
    const VYS_2_ST = 8;
    const VYS_3_ST = 9;

    private $eduText = [
        1 => 'základné vzdelanie',
        2 => 'študent strednej školy',
        3 => 'stredoškolské bez maturity',
        4 => 'stredoškolské s maturitou',
        5 => 'nadstavbové/vyššie odborné vzdelanie',
        6 => 'študent vysokej školy',
        7 => 'vysokoškolské I. stupňa',
        8 => 'vysokoškolské II. stupňa',
        9 => 'vysokoškolské III. stupňa'
    ];

    public static function tableName()
    {
        return 'uchadzac_vzdelanie';
    }

    public function getEducationText()
    {
        return $this->eduText[$this->najvyssie_vzdelanie];
    }
}