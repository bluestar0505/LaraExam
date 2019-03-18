<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ActivationService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class ActivationController extends Controller
{

    protected $activationService;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/catalogue';

    /**
     * Create a new controller instance.
     * @param  ActivationService $activationService ;
     * @return void
     */
    public function __construct(ActivationService $activationService)
    {
        $this->activationService = $activationService;
    }

    public function activateUser($token, Request $request)
    {
        if ($user = $this->activationService->activateUser($token)) {
            auth()->login($user);
            $current_time = mt_rand(100000, 999999);
            $user->isLogged = 1;
            $user->session_value = $current_time;
            $user->save();

            $request->session()->put('loggedTime', $current_time);


            return redirect($this->redirectTo);
        }
        return abort(404);
    }
}
