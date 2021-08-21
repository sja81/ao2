<?php


namespace backend\actions\documents;

use common\models\Template;
use common\models\TemplateCategory;
use common\models\TemplateVars;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class AddDocumentsAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('Dook');
            if (isset($data['template_id']) && (int)($data['template_id'])>0) {
                $template = Template::findOne(['id'=>$data['template_id']]);
                $template->updated_at = (new \DateTimeImmutable('now'))->format('Y-m-d H:i:s');
                $template->updated_by = Yii::$app->user->identity->getId();
            } else {
                $template = new Template();
                $template->created_by = Yii::$app->user->identity->getId();
            }
            $template->category_id = $data['category_id'];
            $template->name = trim($data['name']);
            $template->version = trim($data['version']);
            $template->content = $data['content'];
            $template->template_type = $data['template_type'];
            $result = $template->save(false);
            if ($result) {
                return $this->controller->redirect(Url::to(['/documents']));
            }
        }

        return $this->controller->render('add-document',[
                'tpl_vars'      => TemplateVars::find()->all(),
                ]
        );
    }

}