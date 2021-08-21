<?php
namespace backend\controllers;

use yii\db\Exception;
use yii\web\Controller;

class CmsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'posts' => [
                'class' => 'backend\actions\cms\PostsAction'
            ],
            'counter' => [
                'class' => 'backend\actions\cms\CounterAction'
            ],
            'add-post' => [
                'class' => 'backend\actions\cms\AddPostAction'
            ],
            'edit-post' => [
                'class' => 'backend\actions\cms\EditPostAction'
            ],
        ];
    }
}