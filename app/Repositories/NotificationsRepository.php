<?php namespace App\Repositories;

use App\NotificationSubscriber;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Parsedown;
use Illuminate\Support\Facades\Auth;

class NotificationsRepository extends Repository
{
    public function __construct(NotificationSubscriber $model)
    {
        parent::__construct($model);
    }

    public function subscribe($token, $id, $type, $question_id = null) 
    {
        $this->create([
            "token_firebase" => $token,
            "user_id" => $id,
            "type" => $type,
            "question_id" => $question_id,
        ]);
    }
}
