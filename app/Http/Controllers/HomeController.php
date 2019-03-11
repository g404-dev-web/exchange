<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Repositories\AnswerRepository;
use App\Repositories\FabricRepository;
use App\Upvote;
use App\User;
use Illuminate\Support\Facades\Auth;
use Parsedown;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    protected $questionRepository;
    protected $fabricRepository;
    protected $answerRepository;

    public function __construct(QuestionRepository $questionRepository, FabricRepository $fabricRepository, AnswerRepository $answerRepository)
    {
        parent::__construct();
        $this->questionRepository = $questionRepository;
        $this->fabricRepository = $fabricRepository;
        $this->answerRepository = $answerRepository;
    }

    /**
     *
     */
    public function index()
    {
        $fabricId = 0;
        $recentQuestions = $this->questionRepository->getRecent(2);
        $user = Auth::user();
        $userQuestionPreviousVotes = Auth::check() ? Auth::user()->upvotes->pluck('question_id')->all() : [];
        $userAnswerPreviousVotes = Auth::check() ? Auth::user()->upvotes->pluck('answer_id')->all() : [];
        $fabrics = $this->fabricRepository->allFabrics();

        $id = request("filter");
        $search = request("search");
        $category = request("category");
        $params = [];

        if($id) {
            $params["fabric_id"] = $id;
        }

        if($search) {
            $params["search"] = $search;
        }

        if($category) {
            $params["category"] = $category;
        }

        $questions = $this->questionRepository->advancedSearch($params);

        return view('homepage', compact('questions', 'recentQuestions', 'userAnswerPreviousVotes', 'userQuestionPreviousVotes', 'user', 'fabrics', 'fabricId'));
    }


    public function profil(){
        $user = Auth::user();

        $answers_is_selected = $this->answerRepository->answerSelected($user->id);

        return view('profil.index', compact('user', 'answers_is_selected'));
    }

    public function editProfil(Request $request){

        dd($request);
        $user = Auth::user();
        $user->name = $request['name'];
        $user->name = $request['name'];
        $user->save();

        return back();
//        return view('profil.index', compact('user'));

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
