<?php

use App\Repositories\TransactionsRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersBoughtPapers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $papers = \App\Paper::where('active', 1)->get();
        $totalPapers = $papers->count();



        $users = \App\User::all();
        foreach ($users as $user) {
            if ($user->paid == 1) {
                $walletTransaction = new \App\WalletTransaction();
                $walletTransaction->amount = $totalPapers + 5;
                $user->walletTransactions()->save($walletTransaction);

                foreach ($papers as $paper) {
                    (new TransactionsRepository())->buyPaper($user, $paper);
                }

            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('wallet_transactions')->truncate();
    }
}
