<?php
namespace backend\actions\sites;

use common\models\Ucel;
use yii\base\Action;
use common\models\CalendarEventType;
use Yii;

class IndexAction extends Action
{

    public function init()
    {
        return parent::init();
    }

    public function run()
    {

        $calendarEvents = CalendarEventType::find()->all();

        return $this->controller->render('index',[
            'events' => $calendarEvents
        ]);
    }
}