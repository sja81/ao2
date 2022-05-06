<?php

namespace common\widgets;

use Yii;
use yii\base\Widget;

class AoAlerts extends Widget
{
    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();

        foreach ($flashes as $type => $flash) {
            foreach ((array) $flash as $i => $message) {
                $this->alertWindow($type, $message, $i);
            }
            $session->removeFlash($type);
        }
    }

    protected function alertWindow(string $type, string $message, int $i)
    {
        echo $this->render("aoalerts/{$type}", [
           'message'    =>  $message,
           'i'          =>  $i
        ]);
    }

}