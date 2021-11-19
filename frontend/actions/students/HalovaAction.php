<?php

namespace frontend\actions\students;

use common\models\Jazyk;
use common\models\schools\StudentLanguage;
use common\models\schools\Students;
use common\models\schools\StudentSchoolReport;
use common\models\Stat;
use yii\base\Action;
use yii\helpers\Url;
use Yii;

class HalovaAction extends Action
{
    public function run()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $studentId = $data['sid'];
            $tr = Yii::$app->db->beginTransaction();
            try {
                $this->processPostData($data);
                $tr->commit();
            } catch(\Exception $e) {
                $tr->rollBack();
            }
            $this->controller->redirect(Url::to(['/students/thank-you/'.$data['sid']]));
        } else {
            $student = new Students();
            $student->save();
            $studentId = $student->id;
            unset($student);
        }

        return $this->controller->render('indexHalova',[
            'studyFields'   =>  $this->getAllStudyFields(),
            'staty'         => Stat::find()->where(['=','status',1])->all(),
            'jazyk'         => Jazyk::find()->asArray()->all(),
            'studentId'       => $studentId
        ]);
    }

    private function getAllStudyFields()
    {
        return Yii::$app
            ->db
            ->createCommand("SELECT
                    sf.*
                FROM
                    schoolStudyField ssf
                JOIN
                    studyField sf ON sf.id=ssf.studyFieldId
                WHERE
                    ssf.schoolId = 3;")
            ->queryAll();
    }

    private function processPostData($data)
    {
        $student = Students::findOne(['id'=>$data['sid']]);
        $student->primarySchoolName = $data['primarySchoolName'];
        $student->primarySchoolTown = $data['primarySchoolTown'];
        $student->primarySchoolFrom = $data['primarySchoolFrom'];
        $student->primarySchoolTo = $data['primarySchoolTo'];
        $student->additionalStudy = $data['additionalStudy'];
        $student->otherKnowledges = $data['otherKnowledges'];
        if (isset($data['noConsent']) && $data['noConsent'] == 'on') {
            $student->noConsent = 0;
        }
        if (isset($data['noVideo']) && $data['noVideo'] == 'on') {
            $student->noVideo = 0;
        }
        $student->save();
        foreach($data['Report'] as $year => $items) {
            foreach($items as $subject=>$grade) {
                if ($grade !== '') {
                    $row = StudentSchoolReport::find()
                        ->andWhere(['=','schoolYear',$year])
                        ->andWhere(['=','subject',$subject])
                        ->andWhere(['=','studentId',$data['sid']])
                        ->one();
                    if(!$row) {
                        $row = new StudentSchoolReport();
                        $row->studentId = $data['sid'];
                        $row->schoolYear = $year;
                        $row->subject = $subject;
                    }
                    $row->grade = $grade;
                    $row->save();
                }
            }
        }
        if ($data['motherLanguage'] != '') {
            $studentLang = StudentLanguage::find()
                ->andWhere(['=','studentId',$data['sid']])
                ->andWhere(['=','motherLanguage',1])
                ->andWhere(['=','languageId',$data['motherLanguage']])
                ->one();
            if (!$studentLang) {
                $studentLang = new StudentLanguage();
                $studentLang->motherLanguage = 1;
                $studentLang->studentId = $data['sid'];
            }
            $studentLang->languageId = $data['motherLanguage'];
            $studentLang->save();
        }

        if (isset($data['otherLanguage']) && is_array($data['otherLanguage'])) {
            foreach ($data['otherLanguage'] as $lang) {
                if($lang['lang'] != '') {
                    $studentLang = new StudentLanguage();
                    $studentLang->studentId = $data['sid'];
                    $studentLang->languageId = $lang['lang'];
                    $studentLang->motherLanguage = 0;
                    $studentLang->level = $lang['level'];
                    $studentLang->save();
                }
            }
        }

    }

}