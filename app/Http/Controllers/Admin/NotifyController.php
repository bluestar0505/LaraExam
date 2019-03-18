<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use DB;
use Illuminate\Http\Request;

use App\User;


class NotifyController extends Controller
{

    /**
     * Display a listing of category
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {


        $notify = DB::table('notify')->get();

        return view('admin.notify.index', compact('notify'));
    }


    public function create()
    {
        $categories = Category::all()->pluck("name", "id")->toArray();


        return view('admin.notify.create', compact('categories'));
    }

    /**
     * Show the form for creating a new category
     *
     * @return \Illuminate\View\View
     */


}
