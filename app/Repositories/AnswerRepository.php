<?php namespace App\Repositories;

use App\Answer;
use Illuminate\Database\Eloquent\Model;

class AnswerRepository extends Repository
{
    public function __construct(Answer $model)
    {
        parent::__construct($model);
    }

    public function getOrdered($questionId)
    {
        return $this->model->withCount('upvotes')->with('user')->where('question_id', $questionId)->orderBy('upvotes_count', 'desc')->get();
    }

    public function count($questionId)
    {
        return $this->model->where('question_id', $questionId)->count();
    }
}