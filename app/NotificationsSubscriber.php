<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NotificationsSubscriber extends Model
{
    use Notifiable;
    
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifications_subscribers';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['token_firebase', 'user_id', 'type', 'question_id'];


    /**
     * Attributes for timestamps
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    // public function user()
    // {
    //     return $this->hasmany('App\User');
    // }

    public function question()
    {
        return $this->belongsTo(App\Question::class);
    }

    /**
     * Route notifications for the FCM channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForFcm($notification)
    {
        return $this->token_firebase;
    }

}
