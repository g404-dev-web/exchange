<?php namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getAllUsers()
    {
        return $this->model->all();
    }

    public function wantedIsAdmin()
    {
        return $this->model->join('fabrics', 'users.fabric_id', '=', 'fabrics.id')->select('fabrics.name as fabricName', 'users.*')->where('is_admin_wanted', '=', 1);
    }
}