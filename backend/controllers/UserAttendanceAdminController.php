<?php



namespace backend\controllers;

use yii\web\Controller;
use Yii;
use yii\helpers\Url;
use yii\web\Response;

class UserAttendanceAdminController extends Controller
{
    public function beforeAction($action)
    {
        if (is_null(Yii::$app->user->identity)) {
            $this->redirect(Url::to(['/site/login']));
            return false;
        }
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',

            ],
            "edit" => ['class' => 'backend\actions\userattendanceadmin\EditAction'],
            "files" => ['class' => 'backend\actions\userattendanceadmin\FilesAction'],
            
        ];
    }

    public function actionIndex(): string
    {
        $sql = "SELECT
        name,description FROM auth_item
    WHERE
        name != 'Admin'
    ";
    $groups = Yii::$app -> db-> createCommand($sql)->queryAll();
    $sql = "SELECT 
        aa.item_name, concat(a.name_first,' ', a.name_last) AS meno, a.email, a.phone,aa.user_id
    FROM 
        auth_assignment aa
    JOIN
        agent a ON a.user_id = aa.user_id
    WHERE
        aa.item_name != 'Admin'";
        $students = Yii::$app ->db->createCommand($sql)->queryAll();
 
        
    return $this->render('index',[
        'students'=>$students, 
            'groups'=>$groups
        ]);
    }

    public function actionListStudents()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = ['status'=>'ok'];
        $group = Yii::$app->request->post("group");
        $sql ="SELECT 
        CONCAT(a.name_first,' ', a.name_last) as meno, a.email, a.phone, aa.item_name, a.user_id
    FROM 
        agent a 
    JOIN 
        auth_assignment aa ON aa.user_id = a.user_id 
    WHERE
        aa.item_name = :group
        ";
        $groups = Yii::$app->db->createCommand($sql)->bindParam(':group',$group)->queryAll();
        $this->layout=false;
        $result["response"]=$this->render('group',[
            "students" => $groups,
        ]);
        return $result;
    }
    
   




}