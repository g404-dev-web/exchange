<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Fabric
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fabric newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fabric newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fabric query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Question[] $questions
 */
class Fabric extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fabrics';

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
    protected $fillable = ['name'];

    /**
     * Attributes for timestamps
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /*public function user()
    {
        return $this->hasmany('App\User');
    }*/

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
