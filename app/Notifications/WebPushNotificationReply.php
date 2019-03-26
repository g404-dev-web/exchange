<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

use Benwilkins\FCM\FcmMessage;

class WebPushNotificationReply extends Notification
{
    use Queueable;

    protected $questionTitle;

    /**
     * Create a new notification instance.
     *
     * @param $questionTitle
     */
    public function __construct($questionTitle)
    {
        $this->questionTitle = $questionTitle;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['fcm'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail()
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            //
        ];
    }

    /**
     *
     * @param  mixed $notifiable
     *
     * @return FcmMessage
     */
    public function toFcm($notifiable)
    {

        $message = new FcmMessage();
        $message->content([
            'title'        => "Votre question '" . $this->questionTitle . "' a reçu une réponse",
            'body'         => "",
            'sound'        => '', // Optional
            'icon'         => '', // Optional
            'click_action' => '' // Optional
        ])->data([
            'param1' => 'baz' // Optional
        ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.

        return $message;
    }
}
