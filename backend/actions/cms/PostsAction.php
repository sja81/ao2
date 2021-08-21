<?php
namespace backend\actions\cms;

use common\models\Post;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class PostsAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $params = Yii::$app->request->get();
        $page = isset($params['p']) ? (int)$params['p'] : 1;

        $posts = Post::find();
        $where = [];
        $postsCountQuery = clone $posts;

        if (!empty($where)) {
            $andWhere = implode(' and ',$where);
            $posts->where($andWhere);
        }

        if (!is_null($page) && is_int($page) && $page > 0) {
            $posts->offset(($page-1) * 20)->limit(20);
        }


        return $this->controller->render('posts/index',[
            'posts' => $posts->all(),
            'pocet'     =>  $postsCountQuery->count(),
            'akt_strana'    => $page,
        ]);
    }
}