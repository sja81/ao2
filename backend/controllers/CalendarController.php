<?php

namespace backend\controllers;

use common\models\CalendarEvent;
use common\models\CalendarEventType;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\helpers\Url;

class CalendarController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionSettings()
    {
        $events = CalendarEvent::find()->all();

        return $this->render('settings', [
            'events' => $events
        ]);
    }

    public function actionAdd()
    {
        $calendar = new CalendarEvent();
        $calendarEventTypes = CalendarEventType::find()->all();
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            foreach ($data as $item => $value) {
                $calendar->$item = $value;
            }
            $calendar->save();
            return $this->redirect('/backoffice/calendar/settings');
        }
        return $this->render('add', [
            'calendarInfo' => $calendar,
            'eventTypes' => $calendarEventTypes
        ]);
    }

    public function actionEdit(int $on)
    {
        $calendar = CalendarEvent::find()->where(['=', 'id', $on])->all();

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('data');
            foreach ($data as $id => $item) {
                $calendar = calendarEvent::findOne(['id' => $id]);
                foreach ($item as $col => $val) {
                    $calendar->$col = $val;
                }
                $calendar->save();
            }
            return $this->redirect('/backoffice/calendar/settings');
        }

        return $this->render('edit', [
            'calendar' => $calendar
        ]);
    }

    public function actionImport()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('Import');
            if (empty($_FILES) || $_FILES['DataFile']['type'] != 'application/vnd.ms-excel') {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Nahratý súbor má zlý formát! Nahrajte CSV súbor (UTF8)!'));
            } else {
                $result = $this->processCsvInput($_FILES['DataFile']['tmp_name'], $data['delimiter']);
                $sql = "insert into calendarEvent (`title`,`description`,`status`,`gpsLong`,`gpsLat`,`calendarEventType`)  values %s";
                $rows = [];
                foreach ($result as $item) {
                    $rows[] = "(" . implode(',', [
                        "'{$item['title']}'",
                        "'{$item['description']}'",
                        "'{$item['status']}'",
                        "'{$item['gpsLong']}'",
                        "'{$item['gpsLat']}'",
                        "'{$item['calendarEventType']}'",
                    ]) . ")";
                }
                $sql = sprintf($sql, implode(',', $rows));
                $tr = Yii::$app->db->beginTransaction();
                try {
                    Yii::$app->db->createCommand($sql)->execute();
                    $tr->commit();
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Údaje boli úspešne nahraté'));
                    return $this->redirect(Url::to(['settings']));
                } catch (\Exception $e) {
                    $tr->rollBack();
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            }
        }
        return $this->render('import', []);
    }

    private function processCsvInput(string $csvFile, string $separator): array
    {
        // remove BOM string
        //
        $content = file_get_contents($csvFile);
        file_put_contents($csvFile, str_replace("\xEF\xBB\xBF", '', $content));

        $result = [];
        if (($hFile = fopen($csvFile, "r")) !== FALSE) {
            while (($data = fgetcsv($hFile, 1000, $separator)) !== FALSE) {
                $result[] = [
                    'title'                     =>  $this->sanitizeString($data[0]),
                    'description'               =>  $this->sanitizeString($data[1]),
                    'status'                    =>  $this->sanitizeString($data[2]),
                    'gpsLong'                   =>  $this->sanitizeString($data[3]),
                    'gpsLat'                    =>  $this->sanitizeString($data[4]),
                    'calendarEventType'         =>  $this->sanitizeString($data[5])
                ];
            }
            fclose($hFile);
        }

        return $result;
    }

    private function sanitizeString(string $str): string
    {
        return trim($str);
    }
}
