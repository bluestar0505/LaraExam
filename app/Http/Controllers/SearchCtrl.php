<?php

namespace App\Http\Controllers;

use App\Category;
use App\Paper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class SearchCtrl extends Controller
{
    public function submit(Request $request)
    {

        if (Auth::user()->paid <= 0) {


            return redirect('/dopay');
        }

        User::updateActivity();

        $validate = Validator::make($request->all(), [
            'search' => 'required|string|min:1'
        ]);

        if ($validate->fails()) {
            $request->session()->flash('searchError', 'yep');
            return redirect()->back();
        }

        $string = $request->get('search');

        $categories = Category::search($string);
        $papers = Paper::search($string);
        $userPapers = Auth::user()->bought()->pluck('paper_id')->toArray();

        return view('web.search', compact('categories', 'papers', 'userPapers'));
    }
}
