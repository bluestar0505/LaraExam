<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 17.01.2018
 * Time: 12:51
 */

namespace App\Repositories;


use App\Paper;
use App\PayPalPayments;
use App\User;
use App\WalletTransaction;
use DB;
use Auth;

class TransactionsRepository
{

    public function buyPaper(User $user, Paper $paper)
    {
        $boughtPapers = $user->bought()->pluck('papers.id');

        //check for bought paper
        if ($boughtPapers->contains($paper->id)) return false;


        try {
            DB::beginTransaction();

            $sum = WalletTransaction::where('user_id', $user->id)->select(DB::raw('SUM(amount) as wallet_amount'))->lockForUpdate()->first();

            if ($sum['wallet_amount'] >= $paper->price) {

                $walletTransaction = new WalletTransaction();
                $walletTransaction->paper_id = $paper->id;
                $walletTransaction->amount = -$paper->price;
                $user->walletTransactions()->save($walletTransaction);
                DB::commit();
                return true;
            } else {
                DB::rollBack();
                return false;
            }
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function buyCredit(User $user, PayPalPayments $ppPayment)
    {
        if ($ppPayment->state == 'approved') {
            $bonus = 0;
            $previousPurchase = Auth::user()->payPalPayments()
                ->orderBy('created_at', 'desc')
                ->take(2)
                ->get()->toArray();

            if(count($previousPurchase) == 2){
                $previous = $previousPurchase[1];
                // we give 1 bonus when the last purcase was Option B, 19.95
                if($previous['amount'] == 19.95 ||
                    $previous['amount'] == 17.96 ||
                    $previous['amount'] == 15.96){
                    $bonus = 1;
                } elseif($previous['amount'] == 24.95 ||
                    $previous['amount'] == 22.46 ||
                    $previous['amount'] == 19.96){
                    $bonus = 3;
                }
            }

            $walletTransaction = new WalletTransaction();
            $walletTransaction->payment_id = $ppPayment->id;


            switch ($ppPayment->amount) {
                case (9.95):
                case (8.96):
                case (8.95):
                case (8.955):
                case (7.96):
                    $walletTransaction->amount = 3;
                    break;
                case (19.95):
                case (17.95):
                case (17.955):
                case (17.96):
                case (15.96):
                    $walletTransaction->amount = 9 + $bonus;
                    break;
                case (24.95): // C price
                case (22.46): // C price with 10% discount
                case (22.455): // C price with 10% discount
                case (22.45): // C price with 10% discount
                case (19.96): // C price with 20% discount
                    $walletTransaction->amount = 18 + $bonus;
                    break;
                case (37.95):
                case (34.15):
                case (34.155):
                case (34.16):
                case (30.36):
                    $walletTransaction->amount = 40;
                    break;
                default:
                    $walletTransaction->amount = round($ppPayment->amount / 0.598);
                    break;
            }
            $user->walletTransactions()->save($walletTransaction);
            return true;

        } else {
            return false;
        }
    }
}