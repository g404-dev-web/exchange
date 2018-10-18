<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Upvote;
use App\User;
use Illuminate\Support\Facades\Auth;
use Parsedown;
use App\Repositories\QuestionRepository;

class HomeController extends Controller
{
    protected $questionRepository;


    public function __construct(QuestionRepository $questionRepository)
    {
        parent::__construct();
        $this->questionRepository = $questionRepository;
    }

    /**
     *
     */
    public function index()
    {
        $questions = $this->questionRepository->getOrdered();
        $recentQuestions = $this->questionRepository->getRecent(2);

        $userQuestionPreviousVotes = Auth::check() ? Auth::user()->upvotes->pluck('question_id')->all() : [];
        $userAnswerPreviousVotes = Auth::check() ? Auth::user()->upvotes->pluck('answer_id')->all() : [];


        return view('homepage', compact('questions', 'recentQuestions', 'userAnswerPreviousVotes', 'userQuestionPreviousVotes'));
    }

    private function generatePoints()
    {
        foreach (User::all() as $user) {
            $user->points = 0;
            $user->save();
        }
        foreach (Question::all() as $question) {
            $question->user->points += 10;
            $question->user->save();
        }
        foreach (Answer::all() as $answer) {
            $answer->user->points += 5;

            if ($answer->is_selected) {
                $answer->question->user->points += 5;
                $answer->question->user->save();

                $answer->user->points += 50;
            }

            $answer->user->save();
        }
        foreach (Upvote::all() as $upvote) {
            $upvote->user->points += 1;
            $upvote->user->save();
        }
    }
}
