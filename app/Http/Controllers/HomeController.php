<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Upvote;
use App\User;
use Illuminate\Support\Facades\Auth;
use Parsedown;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        $fabricId = 0;
        $recentQuestions = $this->questionRepository->getRecent(2);
        $user = Auth::user();
        $userQuestionPreviousVotes = Auth::check() ? Auth::user()->upvotes->pluck('question_id')->all() : [];
        $userAnswerPreviousVotes = Auth::check() ? Auth::user()->upvotes->pluck('answer_id')->all() : [];
        $fabrics = DB::table('fabrics')->get();

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
        // dd($questions);

        return view('homepage', compact('questions', 'recentQuestions', 'userAnswerPreviousVotes', 'userQuestionPreviousVotes', 'user', 'fabrics', 'fabricId'));
    }


    public function profil(){
        $user = Auth::user();

        $answers_is_selected = DB::table('answers')->where('user_id', $user->id)->where('is_selected', 1)->count();
   
        return view('profil.index', compact('user', 'answers_is_selected'));
    }

    public function editProfil(Request $request){
        $user = Auth::user();
        $user->name = $request['name'];
        $user->name = $request['name'];
        $user->save();

        return view('profil.index', compact('user'));

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
