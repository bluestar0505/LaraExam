<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 17.01.2018
 * Time: 12:39
 */

namespace App\Observers;


use App\PayPalPayments;
use App\Repositories\TransactionsRepository;
use App\WalletTransaction;

class PaymentsObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  PayPalPayments $palPayments
     * @return void
     */
    public function saved(PayPalPayments $palPayments)
    {
        $originalState = $palPayments->getOriginal('state');
        if ($originalState !== 'approved' && $palPayments->state == 'approved') {
            $user = $palPayments->user()->first();
            (new TransactionsRepository)->buyCredit($user, $palPayments);
        }
    }

}