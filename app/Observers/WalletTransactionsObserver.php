<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 17.01.2018
 * Time: 12:39
 */

namespace App\Observers;


use App\WalletTransaction;

class WalletTransactionsObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  WalletTransaction $walletTransaction
     * @return void
     */
    public function saved(WalletTransaction $walletTransaction)
    {
        $user = $walletTransaction->user()->first();
        $user->walletUpdate();
    }

}