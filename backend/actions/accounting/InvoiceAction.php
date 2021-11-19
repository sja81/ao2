<?php
namespace backend\actions\accounting;

use common\models\Invoice;
use Yii;
use yii\base\Action;
use yii\helpers\Url;
use common\models\Office;

class InvoiceAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $officeList = Office::find()->select(['id','name'])->andWhere(['=','status',1])->asArray()->all();
        foreach($officeList as &$office) {
            $office['invoices'] = Yii::$app->db->createCommand("
                SELECT
                    f.id, 
                    f.znak, f.rok, f.mesiac, f.cislo,
                    fo.kontaktna_osoba, 
                    f.typ_faktury, 
                    fo.nazov AS 'odberatel',
                    f.k_uhrade,  
                    f.zaloha,
                    f.status, 
                    f.splatnost, 
                    f.datum_vystavenia 
                FROM 
                    faktura f
                JOIN
                    faktura_dodavatel fd ON fd.faktura_id=f.id
                JOIN
                    faktura_odberatel fo ON fo.faktura_id=f.id
                WHERE 
                    fd.dodavatel_id = {$office['id']}
                ORDER BY
                    f.id DESC
            ")->queryAll();
        }

        return $this->controller->render('invoice/index',[
            'offices'   =>  $officeList
        ]);
    }
}