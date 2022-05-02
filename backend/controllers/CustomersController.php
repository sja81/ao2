<?php

namespace backend\controllers;

use common\models\Customer;
use common\models\CustomerCompany;
use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class CustomersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' => 'backend\actions\customers\IndexAction'
            ],
            'search' => [
                'class' => 'backend\actions\customers\SearchAction'
            ],
            'open'  => [
                'class' => 'backend\actions\customers\OpenAction'
            ]
        ];
    }

    public function actionEdit(int $id)
    {
        $customerCompany  = CustomerCompany::findOne(['id' => $id]);
        $customer  = Customer::findOne(['id' => $id]);

        if (Yii::$app->request->isPost) {
            $customerData = Yii::$app->request->post("Customer");
            $customerCompanyData = Yii::$app->request->post("CustomerCompany");
            foreach ($customerData as $key => $value) {
                    $customer->$key = $value;
            }
            $customer->save();

            foreach ($customerCompanyData as $key => $value) {
                $customerCompany->$key = $value;
            }
            $customerCompany->save();

            return $this->redirect(Url::to(['/customers']));

        }


        return $this->render('edit', [
            'customer' => $customer,
            'customerCompany' => $customerCompany
        ]);
    }
}
