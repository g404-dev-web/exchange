<?php

namespace App\Http\Controllers;

use App\Answer;
use App\NotificationsSubscriber;
use App\Question;
use App\Repositories\AnswerRepository;
use App\Repositories\FabricRepository;
use App\Repositories\NotificationsRepository;
use App\Upvote;
use App\User;
use Illuminate\Support\Facades\Auth;
use Parsedown;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    protected $questionRepository;
    protected $fabricRepository;
    protected $answerRepository;
    protected $notificationsRepository;

    public function __construct(
        QuestionRepository $questionRepository,
        FabricRepository $fabricRepository,
        AnswerRepository $answerRepository,
        NotificationsRepository $notificationsRepository
    ) {
        parent::__construct();
        $this->questionRepository = $questionRepository;
        $this->fabricRepository = $fabricRepository;
        $this->answerRepository = $answerRepository;
        $this->notificationsRepository = $notificationsRepository;
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

        if ($id) {
            $params["fabric_id"] = $id;
        }

        if ($search) {
            $params["search"] = $search;
        }

        if ($category) {
            $params["category"] = $category;
        }

        $questions = $this->questionRepository->advancedSearch($params);

        return view(
            'homepage',
            compact(
                'questions',
                'recentQuestions',
                'userAnswerPreviousVotes',
                'userQuestionPreviousVotes',
                'user',
                'fabrics',
                'fabricId'
            )
        );
    }


    public function profil()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $answers_is_selected = count($this->answerRepository->answerSelected($user->id));

            $notificationAll = $user->notifications()->where('type', 'all')->get()->isNotEmpty();

            return view('profil.index', compact('user', 'answers_is_selected', 'notificationAll'));
        }

        return redirect('/login');
    }

    public function editProfil(Request $request)
    {
        $user = Auth::user();
        $user->name = $request['name'];
        $user->name = $request['name'];
        $user->save();

        if (Hash::check($request->current_password, $user->password)) {
            $request->user()->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
        }

        if(isset($request->token_firebase)) {
            $this->notificationsRepository->subscribe($request->token_firebase, $user->id, 'all');
        } else {
            $subscribeAll = NotificationsSubscriber::where('user_id', Auth::id())->where('type', 'all')->first();
            $subscribeAll->delete();
        }

        return back();
//        return view('profil.index', compact('user'));
    }

    public function editNotificationReply(Request $request)
    {
        if(empty($request->token_firebase)) {
            $subscriberNotificationReply = NotificationsSubscriber::where('user_id', Auth::id())->where('question_id', $request->question_id)->first();
            $subscriberNotificationReply->delete();
        }  else {
            $this->notificationsRepository->subscribe($request->token_firebase, Auth::id(), 'question', $request->question_id);

        }

        return back();
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
