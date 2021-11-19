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
        $sql = "select
                    s.id,
                    concat(s.firstName,' ',s.lastName) as studentName,
                    s.town,
                    s.fullAddress,
                    s.photo,
                    s.email,
                    s.status,
                    concat(
                        REPLACE(s.phoneCountry,'00','+'),
                        s.phoneNumber
                    ) as phone,
                    sc.description,
                    concat(code,' ',name) as odbor,
                    s.status,   
                    (select resultFile from studentTests where studentId=s.id and testType='video') as video,
                    s.primarySchoolTown,
                    s.primarySchoolName,
                    (select code3 from jazyk j join studentLanguage sl on sl.languageId=j.id where sl.studentId=s.id and sl.motherLanguage=1) as matjaz,
                    concat(slr.firstName,' ',slr.lastName) as parentName,
                    slr.email as parentEmail,
                    concat(
                        REPLACE(slr.phoneCountry,'00','+'),	
                        if(SUBSTRING(slr.phoneNumber,1,1)=0,RIGHT(slr.phoneNumber,LENGTH(slr.phoneNumber)-1),slr.phoneNumber)
                    ) as parentPhone,
                    s.iban
                from
                    student s
                join
                    school sc on sc.id=s.schoolId
                join
                    studentLegalRepresentative slr on slr.studentId=s.id
                join
                    studyField sf on sf.id=s.studyFieldId";

        $result = Yii::$app->db->createCommand($sql)->queryAll();

        foreach($result as &$item) {
            $personaTestId = Yii::$app
                ->db
                ->createCommand("select personaResultId from studentTests where studentId={$item['id']}")
                ->queryScalar();
            if ($personaTestId) {
                $item['personaResult'] = Yii::$app
                    ->db
                    ->createCommand("select concat(resultCode,' : ',result) from 16personalities where id={$personaTestId}")
                    ->queryScalar();
            }
            $item['otherLang'] = Yii::$app
                ->db
                ->createCommand("SELECT 
                                            j.code3, sl.level
                                        FROM studentLanguage sl 
                                        JOIN jazyk j ON sl.languageId=j.id
                                        WHERE
                                            sl.studentId={$item['id']} AND sl.motherLanguage=0")->queryAll();
        }

        return $result;

    }
}