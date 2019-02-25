<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use LaravelFCM\Message\OptionsBuilder;
// use LaravelFCM\Message\PayloadDataBuilder;
// use LaravelFCM\Message\PayloadNotificationBuilder;
// use FCM;
use \App\Notifications\Nono;
use App\User;
use App\NotificationSubscriber;
use DB;
use App\Notifications\WebPushNotifications;
use Illuminate\Support\Facades\Notification;

class NotificationsController extends Controller
{

    
    public function send()
    {

        // $notification = NotificationSubscriber::where('user_id', '11')->first();
        // $user = User::where('email', 'marie@marie.com')->first();
        // $notification->notify(new SomeNotifications);
        // \Notification::send($notification, new SomeNotifications);
        $nombreQestions = DB::table('questions')->whereRaw('created_at >= DATE_SUB( NOW(), INTERVAL 12 HOUR)')->count();
        $token_firebase = DB::table('notifications_subscribers')->where('type', 'all')->pluck('token_firebase')->toArray();
        
        Notification::route('fcm', $token_firebase)->notify(new WebPushNotifications($nombreQestions));
    }

    // public function send() {
    //     define('API_ACCESS_KEY','AAAA7xZjOM8:APA91bGgubH34wLoqOFFm2JFw8QK9GBVVM_R9r43nkqYezOurUPkLlVafnxBUXa2bqI0VhRniB9KhWP7VfUArkVOH0iIwRQqd1vjXxOCr3h1eO3Kjl-_dbe1TJmJ15LsOOnXBMyRITJH');
    //     $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    //     $token='fph0SGgg4vY:APA91bHK652iesw8QtY3DHVepg632jp5-rgLs5r8nowcKu20YveexWb0jVLwAOK4nr_JlurI_ZPJRWoM-5Y4All50OoruUgXxIn_NbXlFr-99Q6B_v4wDqN0yDWpzdsig1Iag_wgxVhk';
       
    //     $notification = [
    //         'title' =>'ppl',
    //         'body' => 'body of message.',
    //         'icon' =>'myIcon', 
    //         'sound' => 'mySound'
    //     ];
    //     $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

    //     $fcmNotification = [
    //         //'registration_ids' => $tokenList, //multple token array
    //         'registration_ids'=> [$token], //single token
    //         'notification' => $notification,
    //         'data' => $extraNotificationData,
    //         'priority' => 'high'
    //     ];

    //     $headers = [
    //         'Authorization: key=' . API_ACCESS_KEY,
    //         'Content-Type: application/json'
    //     ];


    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL,$fcmUrl);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
    //     $result = curl_exec($ch);
    //     curl_close($ch);


    //     echo $result;
    // }
    
   
    
    // public function sendNotificationTest()
    // {
    //     $optionBuilder = new OptionsBuilder();
    //     $optionBuilder->setTimeToLive(0);

    //     $notificationBuilder = new PayloadNotificationBuilder('my title');
    //     $notificationBuilder->setBody('Hello world')
    //                         ->setSound('default');

    //     $dataBuilder = new PayloadDataBuilder();
    //     $dataBuilder->addData(['a_data' => 'my_data']);

    //     $option = $optionBuilder->build();
    //     $notification = $notificationBuilder->build();
    //     $data = $dataBuilder->build();

    //     // You must change it to get your tokens
    //     $tokens = Notification::all()->pluck('token_firebase')->toArray();

    //     $downstreamResponse = FCM::sendTo($tokens[0], $option, $notification, $data);


    //     $downstreamResponse->numberSuccess();
    //     $downstreamResponse->numberFailure();
    //     $downstreamResponse->numberModification();

    //     //return Array - you must remove all this tokens in your database
    //     dd($downstreamResponse->tokensToDelete());



    //     //return Array (key : oldToken, value : new token - you must change the token in your database )
    //     $downstreamResponse->tokensToModify();

    //     //return Array - you should try to resend the message to the tokens in the array
    //     $downstreamResponse->tokensToRetry();

    //     // return Array (key:token, value:errror) - in production you should remove from your database the tokens present in this array
    //     $downstreamResponse->tokensWithError();
    // }

    // public function subscribeQuestion(Request $request, $questionId)
    // {
    //     $this->repository->subscribe($request->get('token_firebase'), "question", $questionId);
    // }

    
    
}
