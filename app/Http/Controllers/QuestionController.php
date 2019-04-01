<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Http\Requests\StoreQuestion;
use App\Question;
use App\Repositories\AnswerRepository;
use App\Repositories\NotificationsRepository;
use App\Repositories\QuestionRepository;
use Auth;
use Parsedown;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $questionRepository;
    protected $answerRepository;
    private $notificationsRepository;

    public function __construct(QuestionRepository $questionRepository, AnswerRepository $answerRepository, NotificationsRepository $notificationsRepository)
    {
        parent::__construct();

        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->notificationsRepository = $notificationsRepository;
        $this->middleware('auth', ['except' => ['index', 'show', 'search']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $questions = $this->questionRepository->getNotAnswered();

        $userQuestionPreviousVotes = auth()->check() ? auth()->user()->upvotes->pluck('question_id')->all() : [];

        $recentQuestions = $this->questionRepository->getRecent(2);
        return view('question.index', compact('questions', 'recentQuestions', 'userQuestionPreviousVotes'));
    }

    /**
     * Display a listing of user questions
     *
     * @return \Illuminate\View\View
     */
    public function user()
    {
        $questions = $this->questionRepository->getUserQuestions($this->currentUser->id);
        $questionsCount = $this->questionRepository->countUserQuestions($this->currentUser->id);
        $answersCount = $this->answerRepository->getUserAnswersCount($this->currentUser->id);
        $userQuestionPreviousVotes = auth()->check() ? auth()->user()->upvotes->pluck('question_id')->all() : [];
        $recentQuestions = $this->questionRepository->getRecent(2);

        return view('question.user', compact('questions', 'recentQuestions', 'userQuestionPreviousVotes', 'questionsCount', 'answersCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $question = false;
        return view('question.create', compact('question'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreQuestion $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreQuestion $request)
    {

        $requestData = $request->all();
        $question = $this->questionRepository->create($requestData);

        if (isset($requestData['token_firebase'])) {
            $this->notificationsRepository->subscribe($requestData["token_firebase"], $question->user_id, 'question', $question->id);
        }

        $this->currentUser->points += 10;
        $this->currentUser->save();

        return redirect()
            ->route('questions.show', ['id' => $question->id])
            ->with('flash_message', 'Question added !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @param AnswerRepository $answerRepository
     * @return \Illuminate\View\View
     */
    public function show($id, AnswerRepository $answerRepository)
    {
        $question = $this->questionRepository->show($id);

        // Increment views
        $question->views++;
        $question->save();

        $previousQuestionId = $this->questionRepository->getPreviousId($id);
        $nextQuestionId = $this->questionRepository->getNextId($id);

        $answers = $answerRepository->getOrdered($id);

        $nbrAnswers = $answerRepository->count($id);

        $userQuestionPreviousVotes = auth()->check() ? auth()->user()->upvotes->pluck('question_id')->all() : [];

        $userAnswerPreviousVotes = auth()->check() ? auth()->user()->upvotes->pluck('answer_id')->all() : [];

        $Parsedown = new Parsedown();

        $question->description = $Parsedown->text($question->description);

        $hasSelectedAnswer = Answer::where([
            'is_selected' => 1,
            'question_id' => $question->id
        ])->exists();

        $relatedQuestions = Question::where('category', $question->category)->limit(4)->orderBy('created_at', 'desc')->get();

        foreach ($answers as $answer) {
            $answer->description = $Parsedown->text($answer->description);
        }

        return view('question.show', compact(
            'question', 'answers', 'nbrAnswers', 'nextQuestionId', 'previousQuestionId', 'userAnswerPreviousVotes', 'userQuestionPreviousVotes', 'hasSelectedAnswer', 'relatedQuestions'
        ));
    }
}

