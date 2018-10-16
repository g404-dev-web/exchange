<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question2 extends Model
{
    //
    protected $table = 'questions';

    protected $primaryKey = 'id';

    protected $fillable = ['title','description','category','user_id'];

    protected $date = ['created_at', 'updated_at'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function answer()
    {
        return $this->hasMany('App\Answer');
    }
}
