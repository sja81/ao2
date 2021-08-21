<?php
namespace backend\actions\applicant;

use common\models\uchadzac\Uchadzac;
use common\models\uchadzac\UchadzacDoc;
use common\models\uchadzac\UchadzacJazyk;
use common\models\uchadzac\UchadzacOstatne;
use common\models\uchadzac\UchadzacVzdelanie;
use common\models\uchadzac\UchadzacVzdelanieKurzSkola;
use common\models\uchadzac\UchadzacZamestnanie;
use common\models\uchadzac\UchadzacZamestnaniePolozky;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class ViewAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $id = (int)(\Yii::$app->request->get('id'));
        if ($id == 0) {
            return $this->controller->redirect(Url::to['/applicant']);
        }

        $applicant = Uchadzac::findOne(['id'=>$id]);
        if (!$applicant) {
            return $this->controller->redirect(Url::to['/applicant']);
        }

        return $this->controller->render('view',[
            'applicant'     => $applicant,
            'vzdelanie'     => UchadzacVzdelanie::findOne(['uchadzac_id'=>$applicant->id]),
            'schools'       => UchadzacVzdelanieKurzSkola::find()->where(['uchadzac_id'=>$id])->all(),
            'docs'          => UchadzacDoc::find()->where(['=','uchadzac_id',$applicant->id])->all(),
            'ostatne'       => UchadzacOstatne::findOne(['uchadzac_id'=>$applicant->id]),
            'zamestnanie'   => UchadzacZamestnanie::findOne(['uchadzac_id'=>$applicant->id]),
            'works'         => UchadzacZamestnaniePolozky::find()->where(['uchadzac_id'=>$id])->all(),
            'langs'         => UchadzacJazyk::find()->where(['uchadzac_id'=>$id])->all()
        ]);
    }
}