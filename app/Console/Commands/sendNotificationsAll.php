<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WebPushNotifications;


class sendNotificationsAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificationsAll:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send webpush notification all user register in notifications_subcribers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $numberQuestions = DB::table('questions')->whereRaw('created_at >= DATE_SUB( NOW(), INTERVAL 12 HOUR)')->count();
        $token_firebase = DB::table('notifications_subscribers')->where('type', 'all')->pluck('token_firebase')->toArray();

        Notification::route('fcm', $token_firebase)->notify(new WebPushNotifications($numberQuestions));
    }
}
