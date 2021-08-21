<?php
namespace backend\actions\documents;

use common\models\Template;
use common\models\TemplateVars;
use yii\base\Action;
use yii\helpers\Url;
use Yii;

class EditAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $templateId = Yii::$app->request->get('id');

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('Dook');
            $template = Template::findOne(['id'=>$data['id']]);
            if ($data['category_id'] != $template->category_id) {
                $template->name = $data['name'];
            }
            if ($data['name'] != $template->name) {
                $template->name = $data['name'];
            }
            if ($data['version'] != $template->version) {
                $template->version = $data['version'];
            }
            if ($data['template_type'] != $template->template_type) {
                $template->template_type = $data['template_type'];
            }
            $template->content = $data['content'];
            $result = $template->save();
            if ($result) {
                return $this->controller->redirect(Url::to(['/documents']));
            }
        }

        return $this->controller->render('edit',[
            'tpl_vars'      => TemplateVars::find()->all(),
            'template'      =>  Template::findOne(['id'=>$templateId])
        ]);
    }
}