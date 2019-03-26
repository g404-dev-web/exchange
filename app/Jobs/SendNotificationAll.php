<?php

namespace App\Jobs;

use App\Notifications\WebPushNotifications;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendNotificationAll implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $intervalHours;

    /**
     * Create a new job instance.
     *
     * @param int $intervalHours
     */
    public function __construct($intervalHours = 12)
    {
        $this->intervalHours = $intervalHours;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $numberQuestions = DB::table('questions')->whereRaw('created_at >= DATE_SUB( NOW(), INTERVAL '.$this->intervalHours.' HOUR)')->count();
        $firebaseTokens = DB::table('notifications_subscribers')->where('type', 'all')->pluck('token_firebase')->toArray();

        $firebaseTokens = array_values(array_unique($firebaseTokens));

        Notification::route('fcm', $firebaseTokens)->notify(new WebPushNotifications($numberQuestions));
    }
}
