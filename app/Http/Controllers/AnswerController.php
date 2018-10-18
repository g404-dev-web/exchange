<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\AnswerRepository;
use App\Http\Requests\StoreAnswer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    protected $answerRepository;

    public function __construct(AnswerRepository $answerRepository)
    {

        parent::__construct();

        //$this->answerRepository = new AnswerRepository();
        $this->answerRepository = $answerRepository;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreAnswer $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreAnswer $request)
    {
        
        $requestData = $request->all();

        $this->answerRepository->create($requestData);

        $this->currentUser->points += 5;
        $this->currentUser->save();

        return redirect()->route('questions.show', ['id' => $request->get('question_id')]);
    }

}
