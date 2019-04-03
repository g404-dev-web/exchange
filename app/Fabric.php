<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
