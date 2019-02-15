<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upvote extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'upvotes';

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
    protected $fillable = ['answer_id', 'user_id', 'question_id'];



    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function answer()
    {
        return $this->belongsTo('App\Answer');
    }
}
