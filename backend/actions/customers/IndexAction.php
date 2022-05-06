<?php
namespace backend\actions\customers;

use Yii;
use yii\base\Action;
use yii\helpers\Url;
use common\models\Customer;
use common\models\Agent;

class IndexAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }
        //id, 


        $sql = "SELECT 
        c.id,
        if(c.customer_type = 'firma', cc.obchodne_meno, CONCAT(c.name_last, ' ', c.name_first)) AS meno,
        if(c.customer_type = 'firma', cc.ico, c.ssn) AS ssnico,
         c.email, c.phone, c.created_at, c.town, c.zip,
        if(c.customer_type = 'firma', cc.adresa, c.address) AS adresa
    
    FROM 
        customer c
    LEFT JOIN
        customer_company cc ON cc.customer_id = c.id";

        $customers = Yii::$app->db->createCommand($sql)->queryAll();

        return $this->controller->render('index',[
            'customers'     => $customers
        ]);
    }
}