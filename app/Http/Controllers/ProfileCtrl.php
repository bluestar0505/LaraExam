<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileCtrl extends Controller
{
    public function index()
    {

        User::updateActivity();

        $profile = Auth::user();

        return view('web.profile', compact('profile'));
    }

    public function store(Request $request)
    {

        $profile = User::findOrFail(Auth::user()->id);
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'password' => 'string|min:6|confirmed'
        ]);

//        dd($request->all());

        $input = $request->only('name', 'password');

        if ($request->has('password') && !empty(trim($input['password']))) {
            if(!Hash::check($request->old_password, $profile->password))
            {
                return back()->with('error', 'Old password incorrect');
            }
            $input['password'] = bcrypt($input['password']);
        } else {
            unset($input['password']);
        }

        
        if ($profile) $profile->update($input);

        $request->session()->flash('profile', 'success');
        return redirect()->route('profile.index');

    }


}
