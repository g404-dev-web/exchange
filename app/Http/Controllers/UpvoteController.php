<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Http\Requests\StoreUpvote;
use App\Http\Controllers\Controller;
use App\Repositories\UpvoteRepository;

class UpvoteController extends Controller
{

    protected $upvoteRepository;

    public function __construct(UpvoteRepository $upvoteRepository)
    {
        parent::__construct();

        $this->upvoteRepository = $upvoteRepository;

        $this->middleware("auth");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreUpvote $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreUpvote $request)
    {
        
        $requestData = $request->all();
        
        $this->upvoteRepository->create($requestData);

        $this->currentUser->points += 1;
        $this->currentUser->save();

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreUpvote $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function select(StoreUpvote $request)
    {

        $requestData = $request->all();

        $answer = Answer::find($requestData["answer_id"]);
        $answer->update([
            'is_selected' => 1
        ]);

        $this->currentUser->points += 5;
        $this->currentUser->save();

        $answer->user->points += 50;
        $answer->user->save();

        return redirect()->back();
    }


}
