<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class PurchaseHistoryController extends Controller {

	/**
	 * Display a listing of purchase history
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $purchases = DB::table('wallet_transactions')
            ->join('users', 'wallet_transactions.user_id', '=', 'users.id')
            ->join('papers', 'wallet_transactions.paper_id', '=', 'papers.id')
            ->select(
                    'users.name as userName',
                    'users.email as userEmail',
                    'papers.name as paperName',
                    'wallet_transactions.id',
                    'wallet_transactions.amount'
            )
            ->get();

		return view('admin.purchasehistory.index', compact('purchases'));
	}
}
