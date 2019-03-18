<?php
//namespace Laraveldaily\Quickadmin\Controllers;
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Paper;
use App\Repositories\TransactionsRepository;
use App\User;
use Illuminate\Http\Request;
use Laraveldaily\Quickadmin\Models\UsersLogs;
use Yajra\Datatables\Datatables;

class UserActionsController extends Controller
{
    /**
     * Show User actions log
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.qa.logs.index');
    }

    public function tokensGive(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);

        $walletTransaction = new \App\WalletTransaction();
        $walletTransaction->amount = $request->input('amount', 0);
        $user = User::find($request->input('user_id'));
        $user->walletTransactions()->save($walletTransaction);

        return back()->with(['success' => 'Tokens transferred.']);
    }

    public function paperGive(Request $request)
    {
        $this->validate($request, [
            'paper_id' => 'required|exists:papers,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $walletTransaction = new \App\WalletTransaction();
        $walletTransaction->amount = 1;
        $user = User::find($request->input('user_id'));
        $user->walletTransactions()->save($walletTransaction);

        $paper = Paper::find($request->input('paper_id'));

        (new TransactionsRepository())->buyPaper($user, $paper);
        return back()->with(['success' => 'Paper transferred.']);
    }

    public function table()
    {
        return Datatables::of(UsersLogs::with('users')->orderBy('id', 'desc'))->make(true);
    }
}