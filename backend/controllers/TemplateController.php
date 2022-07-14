<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use common\models\Template;
use common\models\PrivilegesTemplates;
use common\models\users\UserGroups;
use yii\db\Expression;

class TemplateController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
            'groups' => UserGroups::find()->asArray()->all(),
            'templates' => Template::find()->asArray()->all(),
            'privileges' => $this->getStatus()
        ]);
    }

    private function getStatus()
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

        return $privileges;
    }

    public function actionChangePrivilege()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $template = Yii::$app->request->post('template');
        $group = Yii::$app->request->post('group');
        $status = Yii::$app->request->post('status');

        $row = PrivilegesTemplates::findOne([
            'template_id' => $template,
            'group_name' => $group
        ]);

        if (!$row) {
            $row = new PrivilegesTemplates();
            $row->template_id = $template;
            $row->group_name = $group;
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
}
