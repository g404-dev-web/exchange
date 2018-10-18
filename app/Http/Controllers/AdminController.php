<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /** @var UserRepository  */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();

        $this->middleware('admin');

        $this->userRepository = $userRepository;
    }

    public function users()
    {
        $users = $this->userRepository->all();

        return view('admin/users', compact('users'));
    }

    public function userLogin($userId)
    {
        auth()->loginUsingId($userId);

        return redirect('/');
    }
}
