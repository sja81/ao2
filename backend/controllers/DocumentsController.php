<?php
namespace backend\controllers;

use common\models\documents\search\Search;
use common\models\Template;
use common\models\TemplateCategory;
use common\models\TemplateVars;
use yii\helpers\StringHelper;
use yii\web\Controller;
use yii\web\Response;
use Yii;

class DocumentsController extends Controller
{
    private $result = ['status' => 'ok'];
    private $toSave = false;

    public function beforeAction($action)
    {
        if (StringHelper::startsWith($action->id,'ajax-')) {
            Yii::$app->response->format = Response::FORMAT_JSON;
        }
        return parent::beforeAction($action);
    }

    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' => 'backend\actions\documents\IndexAction'
            ],
            'add-document' => [
                'class' => 'backend\actions\documents\AddDocumentsAction'
            ],
            'edit' => [
                'class' => 'backend\actions\documents\EditAction'
            ]
        ];
    }

    private function getRefreshedRows(): array
    {
        return TemplateVars::find()
            ->select('code,desc,templ_type')
            ->where(['is','deleted_at',null])
            ->asArray()
            ->all();
    }

    // ----- Methods for template variable manipulation
    public function actionAjaxDeleteTemplateVariable(): array
    {
        $template = Yii::$app->request->post('templvar');
        $this->removeTemplate($template);
        return $this->result;
    }

    public function actionAjaxUpdateTemplateVariable(): array
    {
        ['oldcode'=>$oldCode,'oldtxt'=>$oldText,'newcode'=>$newCode,'newtxt'=>$newText] = Yii::$app->request->post();
        $variable = TemplateVars::findOne(['code'=>$oldCode]);
        if ($oldCode <> $newCode) {
            $variable->code = $newCode;
            $this->toSave = true;
        }
        if ($oldText <> $newText) {
            $variable->desc = $newText;
            $this->toSave = true;
        }
        if ($this->toSave) {
            $res = $variable->save();
            if (!$res) {
                $this->result['status'] = 'error';
                $this->result['message'] = 'Error occured during the data save!';
                return $this->result;
            }
        }
        $this->result['details'] = $this->getRefreshedRows();
        return $this->result;
    }

    public function actionAjaxAddTemplateVariable(): array
    {
        ['code'=>$code,'descr'=>$description] = Yii::$app->request->post();

        $variable = new TemplateVars();
        $variable->code = $code;
        $variable->desc = $description;
        $variable->templ_type = 'var';
        $res = $variable->save();
        if (!$res) {
            $this->result = [
                'status'    => 'error',
                'message'   => 'Error occured during the data save!'
            ];
            return $this->result;
        }
        $this->result['details'] = $this->getRefreshedRows();
        return $this->result;
    }

    private function removeTemplate($template): bool
    {
        $variable = TemplateVars::findOne(['code' => $template]);
        if (!$variable) {
            $this->result['status'] = 'error';
            $this->result['message'] = 'Variable or block was not found!';
            return false;
        } else {
            $variable->deleted_at = (new \DateTimeImmutable('now'))->format('Y-m-d H:i:s');
            $variable->deleted_by = Yii::$app->user->getId();
            $res = $variable->save();
            if (!$res) {
                $this->result['status'] = 'error';
                $this->result['message'] = 'Error occured during the data save!';
                return false;
            }
            $this->result['details'] = $this->getRefreshedRows();
        }
        return true;
    }

    // ----- Methods for template block manipulation

    public function actionAjaxGetBlockDetails(): array
    {
        $blockCode = Yii::$app->request->post('block_code');
        $this->result['block_content'] = (TemplateVars::findOne(['code'=>$blockCode]))->content;
        return $this->result;
    }

    public function actionAjaxUpdateTemplateBlock(): array
    {
        [
            'oldcode'       =>$oldCode,
            'oldtxt'        =>$oldText,
            'newcode'       =>$newCode,
            'newtxt'        =>$newText,
            'blockcontent'  => $blockContent
        ] = Yii::$app->request->post();
        $block = TemplateVars::findOne(['code'=>$oldCode]);
        if ($oldCode <> $newCode) {
            $block->code = $newCode;
            $this->toSave = true;
        }
        if ($oldText <> $newText) {
            $block->desc = $newText;
            $this->toSave = true;
        }
        $block->content = $blockContent;
        if ($this->toSave) {
            $res = $block->save();
            if (!$res) {
                $this->result['status'] = 'error';
                $this->result['message'] = 'Error occured during the data save!';
                return $this->result;
            }
        }
        $this->result['details'] = $this->getRefreshedRows();
        return $this->result;
    }

    public function actionAjaxDeleteTemplateBlock(): array
    {
        $template = Yii::$app->request->post('templblk');
        $this->removeTemplate($template);
        return $this->result;
    }

    public function actionAjaxAddTemplateBlock(): array
    {
        [
            'code'      => $code,
            'descr'     => $description,
            'content'   => $content
        ] = Yii::$app->request->post();

        $block = new TemplateVars();
        $block->code = $code;
        $block->desc = $description;
        $block->templ_type = 'blk';
        $block->content = $content;
        $res = $block->save();
        if (!$res) {
            $this->result = [
                'status'    => 'error',
                'message'   => 'Error occured during the data save!'
            ];
            return $this->result;
        }
        $this->result['details'] = $this->getRefreshedRows();
        return $this->result;
    }

    public function actionAjaxAddTemplateCategory()
    {
        [
            'category_ids' => $categoryIds,
            'category_name' => $categoryName
        ] = Yii::$app->request->post();
        $tr = Yii::$app->db->beginTransaction();
        $categoryIds = json_decode($categoryIds);
        try{
            foreach ($categoryIds as $categoryId) {
                $category = new TemplateCategory();
                $category->category_name = $categoryName;
                $category->parent_id = $categoryId;
                $category->status = 1;
                $category->save();
            }
            $tr->commit();
        }catch(\Exception $e) {
            $tr->rollBack();
            $this->result = [
                'status'    => 'error',
                'message'   => $e->getMessage()
            ];
        }
        return $this->result;
    }

    public function actionAjaxGetTemplateFullName()
    {
        ['template_id'=>$templateId] = Yii::$app->request->post();
        $this->result['name'] = 'https://korona.gov.sk/wp-content/uploads/2021/01/44_2021.pdf';
        return $this->result;
    }

    public function actionAjaxSaveCategoryNameUpdate()
    {
        ['category_id'=>$categoryId,'category_name'=>$categoryName] = Yii::$app->request->post();
        $category = TemplateCategory::findOne(['id'=>$categoryId]);
        if (!$category) {
            $this->result['error'] = 'Category with id: ' . $categoryId . ' was not found!';
        } else {
            $category->category_name = $categoryName;
            $res = $category->save();
            if (!$res) {
                $this->result['error'] = 'Category with id: ' . $categoryId . ' was not saved!';
            }
        }
        return $this->result;
    }

    public function actionAjaxDeleteCategory()
    {
        ['category_id'=>$categoryId] = Yii::$app->request->post();
        $category = TemplateCategory::findOne(['id'=>$categoryId]);
        $category->status = 0;
        $res = $category->save();
        if (!$res) {
            $this->result['error'] = 'Category with id: ' . $categoryId . ' was not deleted!';
        }
        return $this->result;
    }

    public function actionDocumentTest($id)
    {
        $document = Template::findOne(['id'=>$id]);
        echo $document->content;
        exit;
    }

    public function actionAjaxAutoSaveDocument()
    {
        $data = Yii::$app->request->post('template_data');
        $template = Template::findOne(['id' => $data['template_id']]);
        if (!$template) {
            $template = new Template();
            $template->created_by = Yii::$app->user->identity->id;
        } else {
            $template->updated_by = Yii::$app->user->identity->id;
            $template->updated_at = (new \DateTimeImmutable('now'))->format('Y-m-d H:i:s');
        }
        $template->version = $data['version'];
        $template->template_type = $data['template_type'];
        $template->category_id = $data['category_id'];
        $template->content = base64_decode($data['content']);
        $template->name = $data['name'];

        $res = $template->save();

        if (!$res) {
            $this->result['error'] = 'Template was not saved...';
        }

        $this->result['template_id'] = $template->id;

        return $this->result;
    }

    public function actionAjaxSearchDocuments()
    {
        $data = Yii::$app->request->post('search_data');

        $search = new Search();
        $search->setSearchTerm($data['sterm']);

        $this->result['items'] = $search->execute();
        $this->result['sterm'] = $data['sterm'];

        return $this->result;
    }

}