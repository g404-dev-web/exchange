<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Notifications\WebPushNotifications;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WebPushNotificationReply;

class NotificationsController extends Controller
{

    public function sendReply($question_id)
    {
        $firebaseToken = DB::table('notifications_subscribers')->where('type', 'question')->where('question_id', $question_id)->first();

        $answerUser = DB::table('answers')
                        ->join('users', 'answers.user_id', '=', 'users.id')
                        ->where('answers.question_id', $question_id)
                        ->select('users.*', 'answers.*')
                        ->orderBy('answers.created_at', 'desc')
                        ->first();


        $questionUser = DB::table('users')
                        ->join('questions', 'users.id', '=', 'questions.user_id')
                        ->where('questions.id', $question_id)
                        ->select('users.*', 'questions.*')
                        ->first();


        Notification::route('fcm', [$firebaseToken])->notify(new WebPushNotificationReply($answerUser, $questionUser));

    }

}
