<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var User|null  */
    protected $currentUser;

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->currentUser = auth()->user();
            view()->share('currentUser', $this->currentUser);
            return $next($request);
        });

        view()->share('routeIsQuestionShow', request()->is('questions.show'));
    }
}
