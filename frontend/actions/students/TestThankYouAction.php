<?php
namespace frontend\actions\students;

use common\models\schools\Students;
use yii\base\Action;
use Yii;

class TestThankYouAction extends Action
{
    public function run()
    {
        $id = Yii::$app->request->get('id');
        $student = Students::findOne(['id'=>$id]);

        $name = $student->firstName . ' ' . $student->lastName;

        unset($student);

        Yii::$app
            ->mailer
            ->compose(['text' => 'finishedTest-text'],['studentName'=>$name,'datum'=>(new \DateTime('now'))->format('Y-m-d H:i:s')])
            ->setFrom('info@aoreal.sk')
            ->setTo('szabo.balazs@aoreal.sk')
            ->setBcc('sksja1981@gmail.com')
            ->setSubject('Dokonceny test')
            ->send();

        return $this->controller->render('tests/thank-you');
    }
}