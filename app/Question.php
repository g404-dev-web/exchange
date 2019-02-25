<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Searchable;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'questions';

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
    protected $fillable = ['title', 'description', 'category', 'user_id'];

    /**
     * Attributes for timestamps
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function upvotes()
    {
        return $this->hasMany('App\Upvote');
    }

    public function searchableAs()
    {
        return 'questions_index';
    }

    public function notification() {
        return $this->hasMany(App\Notification::class);
    }
}
