<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Rackbeat\UIAvatars\HasAvatar;
use Illuminate\Notifications\Notifiable;

/**
 * @method static create(array $array)
 */
class User extends Authenticatable
{
    use HasAvatar, Notifiable;

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

    public function fabrics()
    {
        return $this->belongsToMany('App\Fabric')->withTimestamps();
    }

    public function getAvatar($size = 64)
    {
        return $this->getGravatar($this->email, $size);
    }
}
