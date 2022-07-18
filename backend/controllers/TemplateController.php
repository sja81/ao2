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
            'userFunctions' => $funcs->getProperties(ReflectionProperty::IS_PRIVATE),
            'privileges' => $this->actionGetPrivileges(),
            // 'userFunc' => $this->actionUserFunc()
        ]);
    }

    public function actionGetPrivileges()
    {
        $groups = UserGroups::find()->select('name')->asArray()->all();
        $privileges = [];

        foreach ($groups as $group) {
            $tmp = PrivilegesTemplates::find()
                ->select(['template_id'])
                ->andWhere(['=', 'group_name', $group['name']])
                ->andWhere(['=', 'status', 1])
                ->asArray()->all();

            if (count($tmp) == 0) {
                $privileges[$group['name']] = [];
            } else {
                foreach ($tmp as $i) {
                    $privileges[$group['name']][] = $i['template_id'];
                }
            }
        }

        //    $this->renderPartial('tbody', [
        //         'privileges' => $privileges
        //     ]);

        return $privileges;
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

    public function actionUserFunc($data)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return PrivilegesTemplates::find()->where(['user_function' => $data])->all();
    }
}
