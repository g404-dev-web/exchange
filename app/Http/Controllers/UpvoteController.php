<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpvote;
use App\Http\Controllers\Controller;
use App\Repositories\UpvoteRepository;

class UpvoteController extends Controller
{

    protected $upvoteRepository;

    public function __construct(UpvoteRepository $upvoteRepository)
    {
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

        return redirect()->back();
    }


}
