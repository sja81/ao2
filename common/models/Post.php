<?php
namespace common\models;

use yii\db\ActiveRecord;
use common\models\Agent;

class Post extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    public function getPostConfig(bool $assoc = false)
    {
        return json_decode($this->post_config, $assoc);
    }

    public function getAuthorName()
    {
        $agent = Agent::findOne(['user_id'=>$this->post_author]);
        if (!$agent) {
            return 'unknown';
        }
        return $agent->name_first . ' ' . $agent->name_last;
    }

    public function getStatus()
    {
        $status = [
            'published' => 'Publikovane',
            'draft'     => 'Draft',
        ];

        return $status[$this->post_status];
    }

    public function getSlices()
    {
        return $this->hasMany(PostSlice::class, ['post_id'=>'id']);
    }
}