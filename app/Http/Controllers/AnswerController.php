<?php

namespace App\Http\Controllers;

use App\Jobs\SendNotificationReply;
use App\Repositories\AnswerRepository;
use App\Http\Requests\StoreAnswer;
use App\Repositories\NotificationsRepository;
use Illuminate\Http\Request;


class AnswerController extends Controller
{
    protected $answerRepository;
    protected $notificationRepository;

    /**
     * AnswerController constructor.
     * @param AnswerRepository $answerRepository
     * @param NotificationsRepository $notificationsRepository
     */
    public function __construct(AnswerRepository $answerRepository, NotificationsRepository $notificationsRepository)
    {
        parent::__construct();

        //$this->answerRepository = new AnswerRepository();
        $this->answerRepository = $answerRepository;
        $this->notificationRepository = $notificationsRepository;
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

        /* Check if user owner of question subscribe to notification */
        if($this->notificationRepository->ifUserSubscribeReply($requestData['question_user_id'], $requestData['question_id'])->isNotEmpty()) {

            /* send notification to owner of question */
            dispatch(new SendNotificationReply($requestData['question_id']));
        }

        $this->currentUser->points += 5;
        $this->currentUser->save();

        return redirect()
            ->route('questions.show', ['id' => $request->get('question_id')])
            ->with('flash_message', 'Answer added!');
    }

}
