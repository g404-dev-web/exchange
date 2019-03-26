<?php

namespace App\Jobs;

use App\Notifications\WebPushNotificationReply;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class SendNotificationReply implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $question_id;

    /**
     * Create a new job instance.
     *
     * @param $question_id
     */
    public function __construct($question_id = 63)
    {

        $this->question_id = $question_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        self::notify($this->question_id);
    }

    public static function notify($question_id)
    {
        $firebaseToken = DB::table('notifications_subscribers')
                            ->where('type', 'question')
                            ->where('question_id', $question_id)
                            ->pluck('token_firebase')
                            ->first();

        $question_title = DB::table('questions')
                            ->where('id', $question_id)
                            ->pluck('title')
                            ->first();

        Notification::route('fcm', [$firebaseToken])->notify(new WebPushNotificationReply($question_title));
    }
}
