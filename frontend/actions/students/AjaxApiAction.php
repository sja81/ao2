<?php
namespace frontend\actions\students;

use common\models\schools\StudentLegalRepresentative;
use common\models\schools\StudyField;
use yii\base\Action;
use Yii;
use yii\web\Response;
use common\models\schools\Students;

class AjaxApiAction extends Action
{
    public function run()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $postData = Yii::$app->request->post();
        $methodName = 'json_' . $postData['method'];
        return $this->$methodName($postData['params']);
    }

    private function json_GetStudyFields(array $params)
    {
        $result = Yii::$app
            ->db
            ->createCommand("
        select
            sf.id, sf.code, sf.name
        from
            schoolStudyField ssf
        join
            studyField sf on sf.id=ssf.studyFieldId and ssf.schoolId=:schoolId")
            ->bindParam(':schoolId',$params['schoolid'])
            ->queryAll();

        return [
            'status'    => 'ok',
            'result'    => $result
        ];
    }

    private function json_StoreStudentData(array $params)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $student = Students::findOne(['id'=>$params['studentid']]);
        $legalRep = StudentLegalRepresentative::findOne(['studentId'=>$params['studentid']]);
        if (!$legalRep) {
            $legalRep = new StudentLegalRepresentative();
            $legalRep->studentId = $params['studentid'];
            $legalRep->save();
        }

        $tr = Yii::$app->db->beginTransaction();
        try {
            // go through student data
            foreach($params['student'] as $item) {
                if ($item['value'] != '') {
                    $property = $item['key'];
                    $student->$property = $item['value'];
                }
            }
            $student->save();
            // go through legal representative data and save them
            foreach($params['legalrep'] as $item) {
                if ($item['value'] != '') {
                    $property = $item['key'];
                    $legalRep->$property = $item['value'];
                }
            }
            $legalRep->save();
            $tr->commit();
        } catch (\Exception $e) {
            $tr->rollBack();

            return [
                'status'=>'error',
                'message' => $e->getMessage()
            ];
        }

        return [
            'status'    => 'ok'
        ];

    }
}