<?php namespace App\Repositories;

use App\Question;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Parsedown;

class QuestionRepository extends Repository
{
    /** @var Parsedown  */
    protected $parsedown;

    public function __construct(Question $model)
    {
        parent::__construct($model);

        $this->parsedown = new Parsedown();
    }

    public function getOrdered()
    {
        $questions = $this->model->with('answers', 'upvotes', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        $this->parseDescription($questions);
        $this->addSelectedAnswerFlag($questions);

        return $questions;
    }

    public function getNotAnswered()
    {
        $questions =  $this->model->with('answers', 'upvotes', 'user')
            ->whereNotExists(function (Builder $query) {
                $query->select("answers.question_id")
                    ->from('answers')
                    //->where('is_selected', '1')
                    ->whereRaw('questions.id = answers.question_id');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $this->parseDescription($questions);

        return $questions;

    }

    public function getRecent($nbr)
    {
        $questions = $this->model
            ->orderBy('updated_at', 'desc')
            ->take($nbr)
            ->get();

        $this->parseDescription($questions);

        return $questions;
    }

    public function getUserQuestions($userId)
    {
        $questions = $this->model->with('answers', 'upvotes', 'user')
            ->orderBy('created_at', 'desc')
            ->where('user_id', $userId)
            ->get();

        $this->parseDescription($questions);
        $this->addSelectedAnswerFlag($questions);

        return $questions;
    }

    public function countUserQuestions($userId)
    {
        return $this->model->with('answers')
            ->where('user_id', $userId)
            ->count();
    }

    public function getPreviousId($id)
    {
        return $this->model->where('id', '<', $id)->max('id');
    }

    public function getNextId($id)
    {
        return $this->model->where('id', '>', $id)->min('id');
    }

    private function parseDescription(&$questions)
    {
        foreach ($questions as $question) {
            $question->description = $this->parsedown->text($question->description);
        }
    }

    private function addSelectedAnswerFlag(&$questions)
    {
        foreach ($questions as $question) {
            $question->hasSelectedAnswer = false;
            foreach ($question->answers as $answer) {
                if ($answer->is_selected == "1") {
                    $question->hasSelectedAnswer = true;
                }
            }
        }
    }
}
