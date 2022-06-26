<?php
namespace backend\actions\clients;

use yii\base\Action;
use yii\helpers\Url;
use Yii;

class IndexAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }


        $sql = "SELECT 
        c.id,
        CONCAT(c.name_first,' ',name_last) AS meno, CONCAT(cc.perm_town,' ', cc.perm_street, ' ', cc.perm_zip) AS adresa, 
        CONCAT(cc.mobile_area_code,cc.mobile) AS mobile, c.ssn, c.email, c.created_at
    FROM 
        client c
    LEFT JOIN
        client_contact cc ON cc.client_id = c.id";

        $clients = Yii::$app->db->createCommand($sql)->queryAll();
        return $this->controller->render('index',[
            'clients' => $clients
        ]);
    }
}