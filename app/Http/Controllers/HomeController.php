<?php

namespace App\Http\Controllers;

use Parsedown;
use App\Repositories\QuestionRepository;

class HomeController extends Controller
{
    protected $questionRepository;


    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     *
     */
    public function index()
    {
        $questions = $this->questionRepository->getOrdered();
        $recentQuestions = $this->questionRepository->getRecent(2);

	$Parsedown = new Parsedown();

        foreach($questions as $question) {
                $question->description = $Parsedown->text($question->description);
        }


        foreach($recentQuestions as $recentQuestion) {
                $recentQuestion->description = $Parsedown->text($recentQuestion->description);
        }


        return view('homepage', compact('questions', 'recentQuestions'));
    }

}
