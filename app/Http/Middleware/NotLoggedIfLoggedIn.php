<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

use Illuminate\Support\Facades\Auth;

class NotLoggedIfLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {


        if (Auth::guard($guard)->check()) {

//            if (Auth::user()->paid <= 0) {
//                return redirect('/dopay');
//            }

            $user_loggedTime = Auth::user()->session_value;
            $user_logged = $request->session()->get('loggedTime');

            if ($user_loggedTime != $user_logged) {
                $request->session()->flash('anotherdevice', 'anotherdevice');
                Auth::logout();
                return redirect('/');
            }

        }

        return $next($request);
    }
}



