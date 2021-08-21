<?php
namespace frontend\controllers;

use common\models\Applications;
use common\models\FinancialInstitutionText;
use common\models\NehnutelnostDruhy;
use common\models\Stat;
use common\models\AcademicDegrees;
use yii\web\Controller;
use common\models\FinancialInstitution;

class AppRequestEngController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $degrees = new AcademicDegrees();
        return $this->render('index',[
            'titul_pred'    => $degrees->getTitulPredMenom(),
            'titul_za'      => $degrees->getTitulZaMenom(),
            'staty'         => Stat::find()->where(['=','status',1])->all(),
            'marital_status' => FinancialInstitutionText::find()
                ->select(['id','internal_text'])
                ->andWhere(['is','deleted_at',null])
                ->andWhere(['=','category',FinancialInstitutionText::MARITAL_STATUS])
                ->asArray()->all(),
            'banks'         =>  (new FinancialInstitution())->getAllActiveBanks(),
            'educations'    =>  FinancialInstitutionText::find()
                ->select(['id','internal_text'])
                ->andWhere(['is','deleted_at',null])
                ->andWhere(['=','category',FinancialInstitutionText::EDUCATION])
                ->asArray()->all(),
            'cust_docs'     =>  FinancialInstitutionText::find()
                ->select(['id','internal_text'])
                ->andWhere(['is','deleted_at',null])
                ->andWhere(['=','category',FinancialInstitutionText::CUSTDOCS])
                ->asArray()->all(),
            'living'        =>  FinancialInstitutionText::find()
                ->select(['id','internal_text'])
                ->andWhere(['is','deleted_at',null])
                ->andWhere(['=','category',FinancialInstitutionText::LIVING])
                ->asArray()->all(),
            'property_type' =>  NehnutelnostDruhy::find()
                ->select(['id','nazov'])
                ->andWhere(['in','kategoria_id',[1,2]])
                ->andWhere(['=','status',1])
                ->asArray()->all(),
            'bonus_freq'    =>  FinancialInstitutionText::find()
                ->select(['id','internal_text'])
                ->andWhere(['is','deleted_at',null])
                ->andWhere(['=','category',FinancialInstitutionText::BONUS_FREQUENCY])
                ->asArray()->all(),
            'legal_form'    =>  FinancialInstitutionText::find()
                ->select(['id','internal_text'])
                ->andWhere(['is','deleted_at',null])
                ->andWhere(['=','category',FinancialInstitutionText::LEGALFORM])
                ->asArray()->all(),
            'professions'    =>  Applications::find()
                ->select(['id','title'])
                ->asArray()->all(),
            'industry'      =>  FinancialInstitutionText::find()
                ->select(['id','internal_text'])
                ->andWhere(['is','deleted_at',null])
                ->andWhere(['=','category',FinancialInstitutionText::INDUSTRY])
                ->asArray()->all(),
        ]);
    }
}