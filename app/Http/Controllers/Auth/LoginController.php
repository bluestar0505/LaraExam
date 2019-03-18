<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AuthUsers;
use App\User;
use Auth;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

//    use AuthenticatesUsers;
    use AuthUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->redirectTo = config('quickadmin.route');


        $this->redirectTo = User::LOGIN_REDIRECT_TO;
        $this->middleware('guest', ['except' => 'logout']);

    }

    public function redirectTo()
    {
        return Auth::user()->redirectTo();
    }
}