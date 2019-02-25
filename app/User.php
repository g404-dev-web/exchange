<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'remember_token', 'is_admin', 'fabric_id'];

    /**
     * Attributes for timestamps
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function upvotes()
    {
        return $this->hasMany('App\Upvote');
    }

    public function fabric()
    {
        return $this->belongsTo('App\Fabric');
    }

}
