<?php namespace App\Repositories;

use App\NotificationsSubscriber;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class NotificationsRepository extends Repository
{
    public function __construct(NotificationsSubscriber $model)
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

    public function ifUserSubscribeReply($user_id, $question_id)
    {
        return $subscriber = DB::table('notifications_subscribers')->where([
                                ['user_id', '=' ,$user_id],
                                ['question_id', '=', $question_id],
                                ['type', '=', 'question']
                            ])->get();
    }


}
