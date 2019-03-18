<?php

namespace App\Http\Controllers;

use App\Traits\PayPalTrait;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayPalController extends Controller
{
    use PayPalTrait;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $current_time = mt_rand(100000, 999999);
        $user = Auth::user();

        if ($user) {
            $user->isLogged = 1;
            $user->session_value = $current_time;
            $user->save();
        }

        $request->session()->put('loggedTime', $current_time);
        return view('web.paypal');
    }

    public function buyMoreTokens()
    {
        $reduction = 0;
        $lastPaymentMade = Auth::user()->payPalPayments()
            ->where(['state' => 'approved'])
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->first();

        if(isset($lastPaymentMade)){
            $amount = $lastPaymentMade->amount;

            switch($amount){
                case(9.95):
                case(8.95):
                case(8.955):
                case(8.96):
                case(7.96):
                    $reduction = 10;
                    break;
                case(24.95):
                case(22.46):
                case(22.455):
                case(22.45):
                case(19.96):
                    $reduction = 20;
            }
            $lastPayment = $amount;
        } else {
            $lastPayment = 0;
        }

        return view('web.buy_more_tokens')->with([
            'lastPayment' => $lastPayment,
            'reduction' => $reduction,
        ]);
    }

    public function dopay(Request $request)
    {
        $current_time = mt_rand(100000, 999999);
        $user = Auth::user();


        if ($user) {
            $user->isLogged = 1;
            $user->session_value = $current_time;
            $user->save();
        }

        $request->session()->put('loggedTime', $current_time);
        return view('web.dopay');
    }


    public function postCreate(Request $request)
    {
        $amount = $request->input('amount', 5);
        $ppResult = $this->ppCreatePayment($amount);
        if ($ppResult) {
            return response(['paymentID' => $ppResult->id]);
        } else {
            return response(['errors' => 'Something going wrong'], 500);
        }
    }

    public function getDone(Request $request)
    {

        $this->validate($request, [
            'paymentID' => 'required|exists:paypal_payments,paypal_id',
            'payerID' => 'required',
        ]);

        $result = $this->ppProcessPayment($request->input('paymentID'), $request->input('payerID'));
        if ($result) {
            return response(['redirect' => 'home']);
        } else {
            return response(['redirect' => 'dopay'], 500);
        }
    }

    public function getCancel()
    {
        return redirect(route('web.index'));
    }
}
