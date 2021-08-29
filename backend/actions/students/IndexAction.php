<?php
namespace backend\actions\students;

use Yii;
use yii\base\Action;
use yii\helpers\Url;
use common\models\schools\Students;

class IndexAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }
        return $this->controller->render('index',[
            'students'  => $this->getStudentsList()
        ]);
    }

    private function getStudentsList(): array
    {
        return Students::find()
            ->select([
                'student.id',
                'student.firstName',
                'student.lastName',
                'student.phoneCountry',
                'student.phoneNumber',
                'school.description',
                'student.email',
                'studyField.code',
                'studyField.name'
            ])
            ->join('inner join','school','school.id=student.schoolId')
            ->join('inner join','studyField','studyField.id=student.studyFieldId')
            ->asArray()
            ->all();
    }
}