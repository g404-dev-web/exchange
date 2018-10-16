<?php

namespace App\Http\Controllers;

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

        return view('homepage', compact('questions', 'recentQuestions'));
    }

}
