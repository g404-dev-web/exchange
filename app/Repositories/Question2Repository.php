<?php namespace App\Repositories;

use App\Question;
use Illuminate\Database\Eloquent\Model;

class QuestionRepository extends Repository
{
    public function __construct(Question $model)
    {
        parent::__construct($model);
    }

    public function getOrdered()
    {
        return $this->model->orderBy('updated_at', 'desc')->get();
    }

    public function getRecent($nbr)
    {
        return $this->model->orderBy('updated_at', 'desc')->take($nbr)->get();
    }
}