<?php
namespace frontend\actions\students;

use common\models\schools\StudentLegalRepresentative;
use common\models\schools\Students;
use yii\base\Action;
use Yii;

class ThankYouAction extends Action
{
    public function run($sid)
    {
        // send email to the student
        $student = Students::findOne(['id'=>$sid]);
        $legalRep = StudentLegalRepresentative::findOne(['studentId'=>$sid]);

        Yii::$app
            ->mailer
            ->compose(['text' => 'studentRegistration-text'],['studentName'=>$student->firstName . ' ' .$student->lastName])
            ->setFrom('info@aoreal.sk')
            ->setTo([$student->email, $legalRep->email, 'szabo.balazs@aoreal.sk'])
            ->setSubject('Úspešná registrácia')
            ->send();

        return $this->controller->render('thank-you');

    }
}