<?php

namespace frontend\controllers;

use common\models\schools\Students;
use Yii;
use yii\web\Controller;

class TestMailController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $mailRecips = [
            //['id'=>85, 'name'=>'Banyáková Vanessa','email'=>'tomas.banyak@gmail.com'],
            //['id'=>97, 'name'=>'Bot Ágnes','email'=>'zuzanf@gmail.com'],
            //['id'=>89, 'name'=>'Horváth Eszter Adele','email'=>'adelboros@hotmail.com'],
            //['id'=>84, 'name'=>'Milan Ronald','email'=>'barcikazuzi@hotmail.com'],
            //['id'=>96, 'name'=>'Zsigóová Barbara','email'=>'zsigobarbara19@gmail.com'],
            //['id'=>99, 'name'=>'Csóka Daniel','email'=>'robi.csoka72@gmail.com'],
            //['id'=>104, 'name'=>'Lábadiová Rebeka ','email'=>'rebi6501@gmail.com'],
            //['id'=>103, 'name'=>'Staňová Nina','email'=>'kevezdova@zoznam.sk'],
            //['id'=>102, 'name'=>'Németh Karolin','email'=>'viktornemeth1977@gmail.com'],
            //['id'=>52, 'name'=>'Juhos Réka','email'=>'viktornemeth1977@gmail.com'],
            //['id'=>53, 'name'=>'Szőcs Dóra','email'=>'viktornemeth1977@gmail.com'],
            //['id'=>67, 'name'=>'Bors Nikolett','email'=>'viktornemeth1977@gmail.com'],
            ['id'=>119, 'name'=>'Zoja Duduczova', 'email'=>'zojaduduczova227@gmail.com'],
            ['id'=>120, 'name'=>'Cintia	Hýrešová','email'=>'cintiahyresova129@gmail.com'],
            ['id'=>121, 'name'=>'Ádám Gódány','email'=>'adamg5215@gmail.com'],
            ['id'=>125, 'name'=>'Kristína Gulášová','email'=>'gulasovakika7@gmail.com'],
            ['id'=>133, 'name'=>'Dominika Kollerova', 'email'=>'dominikakollerova2005@gmail.com'],
            ['id'=>137, 'name'=>'Zoja Duduczová','email'=>'zojaduduczova227@gmail.com'],
            ['id'=>161,'name'=>'Cynthia	Lukácsová','email'=>'lukacscynthia02@gmail.com'],
            ['id'=>165,'name'=>'Dárius Majer','email'=>'dariusxxdd@gmail.com'],
            ['id'=>168,'name'=>'Enikő Hacsiková','email'=>'ehacsik4@gmail.com'],

            /*['name'=>'Kovácsy Ilona Lili','email'=>'kovacsye@gmail.com'],
            ['name'=>'Kovalcsik Emília','email'=>'kovalcsik.monika@gmail.com'],
            ['name'=>'Páloš Teodor','email'=>'teodor@chello.sk'],
            ['name'=>'Horváthová Lara','email'=>'lara6106@gmail.com'],
            ['name'=>'Baloghová Simona','email'=>'simona1981@gmail.com'],*/

        ];

        $messages = [];
        foreach($mailRecips as $recip) {
            $messages[] =  Yii::$app
                ->mailer
                ->compose(['html' => 'inviteForTest-html'],['studentName'=>$recip['name'],'id'=>$recip['id']])
                ->setFrom('info@aoreal.sk')
                ->setCc('szabo.balazs@aoreal.sk')
                ->setBcc('sksja1981@gmail.com')
                ->setTo($recip['email'])
                ->setSubject('Pozvánka na vyplnenie testov');
        }
        Yii::$app->mailer->sendMultiple($messages);

    }
}