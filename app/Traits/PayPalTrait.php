<?php
/**
 * Created by PhpStorm.
 * User: klegotin
 * Date: 02/08/16
 * Time: 16:29
 */

namespace App\Traits;

use App\User;
use App\PayPalPayments;
use Auth;
use Exception;
use PayPal;
use Session;

/**
 * Class PayPalTrait
 * @package App\Traits
 */
trait PayPalTrait
{

    /**
     * @param $totalAmount
     * @param $invoiceId
     * @return bool|PayPal\Api\Payment
     */
    public function ppCreatePayment($amountVar = 5)
    {
        $payer = PayPal::payer();
        $payer->setPaymentMethod('paypal');

//        $item1 = PayPal::item();
//        $item1->setName('')
//            ->setDescription('Examhack.ie payment')
//            ->setCurrency('EUR')
//            ->setQuantity(1)
//            ->setPrice(5);


//        $itemList = PayPal::itemList();
//        $itemList->setItems(array($item1));

        $amount = PayPal::amount();
        $amount->setCurrency('EUR');
        $amount->setTotal($amountVar);

        $transaction = PayPal::transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription("Examhack payment");
//        $transaction->setItemList($itemList);

        $redirectUrls = PayPal::redirectUrls();
        $redirectUrls->setReturnUrl(route('pp:done'));
        $redirectUrls->setCancelUrl(route('pp:cancel'));

        $payment = PayPal::payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions([$transaction]);

        try {
            $response = $payment->create(PayPal::getApiContext());

            $user = Auth::user();
            $newPayPalPayment = new PayPalPayments([
                'paypal_id' => $response->id,
                'amount' => $response->transactions[0]->amount->total,
                'currency' => $response->transactions[0]->amount->currency,
                'state' => $response->state,
            ]);
            $user->payPalPayments()->save($newPayPalPayment);

            return $response;

        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param $paymentId
     * @param $payerId
     * @return bool
     */
    public function ppProcessPayment($paymentId, $payerId)
    {
        if (is_null($paymentId) || is_null($payerId)) return false;

        $payment = PayPal::payment()->get($paymentId, PayPal::getApiContext());

        $execution = PayPal::paymentExecution();
        $execution->setPayerId($payerId);

        try {
            $payment->execute($execution, PayPal::getApiContext());

            $payment = PayPal::payment()->get($paymentId, PayPal::getApiContext());
            if ($payment) {
                $ppPayment = PayPalPayments::where('paypal_id', $payment->id)->firstOrFail();

                if ($ppPayment->state != $payment->state) {
                    $ppPayment->state = $payment->state;
                    $ppPayment->save();

                    if ($ppPayment->state == 'approved') {

                        $user = User::find($ppPayment->user_id);
                        $user->paid = 1;
                        $user->save();
                    }
                }
            }
        } catch (Exception $ex) {
            return false;
        }

        return true;
    }

    public function ppOne($id)
    {
        $result = PayPal::getById($id, PayPal::getApiContext());
        return $result;
    }
}