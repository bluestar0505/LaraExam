<?php
//namespace Laraveldaily\Quickadmin\Controllers;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PayPalPayments;
use App\User;
use DB;

class QuickadminController extends Controller
{
    /**
     * Show QuickAdmin dashboard page
     */
    public function index()
    {
        if (User::isAdmin()) {
            $usersPaid = User::select(DB::raw('count(*) as count'), 'paid')->where('role_id', '=', '0')->groupBy('paid')->get()->pluck('count', 'paid');
            $usersDefaultTab = User::select(DB::raw('count(*) as count'), 'DefaultTab')->where('role_id', '=', '0')->where('paid', '=', '1')->groupBy('DefaultTab')->get()->pluck('count', 'DefaultTab');
//            $latestPayments = PayPalPayments::with('user')->whereState('approved')->latest()->limit(10)->get();

            return view('admin.dashboard', compact('usersPaid', 'usersDefaultTab', 'latestPayments'));
        }
        return redirect('/home');
    }
}