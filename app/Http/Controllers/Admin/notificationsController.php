<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use DB;
use Illuminate\Http\Request;

use App\User;


class notificationssController extends Controller
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
        echo "string";
        exit();

        $suggestions = DB::table('suggestion')->get();
        /* echo "<pre>";
     print_r($suggestions);
     echo "</pre>";
     
          exit();*/
        return view('admin.suggestions.index', compact('suggestions'));
    }

    /**
     * Show the form for creating a new category
     *
     * @return \Illuminate\View\View
     */


}
