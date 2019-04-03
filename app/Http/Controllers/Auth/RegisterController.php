<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\NotificationsRepository;
use App\Repositories\FabricRepository;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /** @var NotificationsRepository */
    protected $notificationsRepository;

    /** @var FabricRepository */
    protected $fabricRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(NotificationsRepository $notificationsRepository, FabricRepository $fabricRepository)
    {
        parent::__construct();
        $this->middleware('guest');
        $this->notificationsRepository = $notificationsRepository;
        $this->fabricRepository = $fabricRepository;
    }

    public function showRegistrationForm()
    {
        $fabrics = $this->fabricRepository->allFabrics();

        return view('auth.register', compact('fabrics'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'fabric_ids.*' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'token_firebase' => 'string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'fabric_id' => $data['fabric_ids'][0],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->fabrics()->attach($data['fabric_ids']);

        if (isset($data['token_firebase'])) {
            $this->notificationsRepository->subscribe($data["token_firebase"], $user->id, 'all');
        }

        return $user;
    }
}
