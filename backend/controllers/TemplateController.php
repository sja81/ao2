<?php

namespace backend\controllers;

use Yii;
use ReflectionClass;
use yii\web\Response;
use yii\db\Expression;
use ReflectionProperty;
use yii\web\Controller;
use common\models\Template;
use common\models\users\UserGroups;
use common\models\PrivilegesTemplates;

class TemplateController extends Controller
{
    public function actionIndex()
    {
        $funcs = new ReflectionClass(get_class(new PrivilegesTemplates));

        return $this->render('index', [
            'groups' => UserGroups::find()->asArray()->all(),
            'templates' => Template::find()->asArray()->all(),
            'userFunctions' => $funcs->getProperties(ReflectionProperty::IS_PROTECTED),
            'privileges' => $this->getPrivileges(),
        ]);
    }

    private function getPrivileges(?string $userFunction = null)
    {
        $groups = UserGroups::find()->select('name')->asArray()->all();
        $results = [];

        foreach ($groups as $group) {
            $privileges = PrivilegesTemplates::find()
                ->select(['template_id'])
                ->andWhere(['=', 'group_name', $group['name']])
                ->andWhere(['=', 'status', 1]);

                if(!is_null($userFunction))
                {
                    $privileges->andWhere(['=', 'user_function', $userFunction]);
                }
               $tmp =  $privileges->asArray()->all();

            if (count($tmp) == 0) {
                $results[$group['name']] = [];
            } else {
                foreach ($tmp as $i) {
                    $results[$group['name']][] = $i['template_id'];
                }
            }
        }
        return $results;
    }

    public function actionChangePrivilege()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $template = Yii::$app->request->post('template');
        $group = Yii::$app->request->post('group');
        $status = Yii::$app->request->post('status');
        $function = Yii::$app->request->post('function');

        $row = PrivilegesTemplates::findOne([
            'template_id' => $template,
            'group_name' => $group,
        ]);

        if (!$row) {
            $row = new PrivilegesTemplates();
            $row->template_id = $template;
            $row->group_name = $group;
            $row->user_function = $function;
            $row->created_at = new Expression('NOW()');
        }
        $row->updated_at = new Expression('NOW()');

        $tr = Yii::$app->db->beginTransaction();
        try {
            $row->status = (int)$status;
            $row->save();
            $tr->commit();
        } catch (\Exception $e) {
            $tr->rollBack();
            return ['status' => 'error', 'message' => Yii::t('app', 'Status nebol zmenený!')];
        }
        return ['status' => 'ok', 'message' => Yii::t('app', 'Status bol zmenený!')];
    }

    public function actionUserFunc()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Yii::$app->request->post('data');

        $body = $this->renderPartial('tbody', [
            'groups' => UserGroups::find()->asArray()->all(),
            'templates' => Template::find()->asArray()->all(),
            'privileges' => $this->getPrivileges($data)
        ]);

        return [
            'status' => 'ok',
            'tbody' => $body
        ];
    }
}
