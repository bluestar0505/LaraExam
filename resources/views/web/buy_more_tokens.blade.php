@extends('layouts.app')

@section('content')
    <div class="user-store">
        <div class="panel">
            <div class="panel-heading panel-success" style="padding-left: 40px;background-color: #4389BC;color: white; min-height: 180px;">
                <h3 class="pageHed">
                    Solution Store
                    <small>Add tokens to your wallet</small>
                </h3>
            </div>
            <div class="panel-body paymentSec" style="padding-left: 100px;padding-right: 100px; padding-top: 50px;color: white;">

                <div class="row">
                    <div class="columns" style="color: white">
                        <ul class="price">
                            <li class="header" style="background-color: #76C3F1"><span>3</span> Tokens</li>
                            <li class="description" style="background-color: #76C3F1">
                                <p><strong>+10% off </strong> on your next purchase</p>
                            </li>
                            <li class="sum" style="color: #76C3F1">
                                <h4>9<span class="sup">.95</span>{{ $reduction > 0 ? ' - '. $reduction . '%' :'' }}</h4>
                            </li>

                            <li class="option" style="background-color: #76C3F1">
                                <span class="cartIco">
                                    <i class="fa fa-shopping-cart"></i>
                                </span>
                                    <label>
                                    Option A &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="payment-amount" id="optionsRadios1"
                                           value="{{ $reduction > 0 ? 9.95 - 9.95/100*$reduction : '9.95'  }}" >
                                </label>
                            </li>
                        </ul>
                    
                    </div>

                    <div class="columns">
                        <ul class="price">
                            <li class="header" style="background-color:#54A5CD"><span>9</span> Tokens</li>
                            <li class="description" style="background-color:#54A5CD">
                                <p><strong>+1 free token </strong> with your next purchase</p>
                            </li>
                            <li class="sum" style="color: #54A5CD">
                                <h4>19<span class="sup">.95</span>{{ $reduction > 0 ? ' - '. $reduction . '%' :'' }}</h4>
                            </li>
                            <li class="option" style="background-color:#54A5CD">
                                <span class="cartIco">
                                    <i class="fa fa-shopping-cart fa-lg"></i>
                                </span>
                                <label>
                                    Option B &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="payment-amount" id="optionsRadios1"
                                           value="{{ $reduction > 0 ? 19.95 - 19.95/100*$reduction : '19.95'  }}" >
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="columns" style="position: relative">
                        <ul class="price">
                            <li class="header" style="background-color:#5387AD">
                                <span>18</span> Tokens
                            </li>
                            <li class="description" style="background-color:#5387AD">
                                <p><strong>+20% off </strong> on your next purchase</p>
                                <p><strong>+3 free tokens </strong> with your next purchase</p>
                            </li>
                            <li class="sum" style="color: #5387AD">
                                <h4>24<span class="sup">.95</span>{{ $reduction > 0 ? ' - '. $reduction . '%' :'' }}</h4>
                            </li>
                            <li class="option" style="background-color:#5387AD">
                                <span class="cartIco">
                                    <i class="fa fa-shopping-cart fa-lg"></i>
                                </span>
                                <label>
                                    Option C &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="payment-amount" id="optionsRadios1"
                                           value="{{ $reduction > 0 ? 24.95 - 24.95/100*$reduction : '24.95'  }}" checked >
                                </label>
                            </li>
                        </ul>
                        <div class="on-top">Most popular!</div>
                    </div>

                    <div class="columns" style="position: relative">
                        <ul class="price">
                            <li class="header" style="background-color:#386F96"><span>40</span> Tokens</li>
                            <li class="description" style="background-color:#386F96">
                                
                            </li>
                            <li class="sum" style="color: #386F96">
                                <h4>37<span class="sup">.95</span>{{ $reduction > 0 ? ' - '. $reduction . '%' :'' }}</h4>
                            </li>
                            <li class="option" style="background-color:#386F96">
                                <span class="cartIco">
                                    <i class="fa fa-shopping-cart fa-lg"></i>
                                </span>
                                <label>
                                    Option D &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="payment-amount" id="optionsRadios1"
                                           value="{{ $reduction > 0 ? 37.95 - 37.95/100*$reduction : '37.95'  }}" >
                                </label>
                            </li>
                        </ul>
                        <div class="on-top">Ideal for first years!</div>
                    </div>

                </div>
                
                
                <div class="row" style="margin-top: 100px;">
                    <div class="col-md-8 pricing-container">
                        <h1>Pricing:</h1>
                        <div>
                            <p>5ECT Solutions = 1 Solution Token</p>
                            <p>10ECT Solutions = 2 Solution Tokens</p>
                        </div>
                       {{-- @if($reduction > 0)
                            <h4>Discount:</h4>
                            <p>You will receive a {{$reduction}}% discount on your next purchase.</p>
                        @endif--}}
                    </div>
                    <div class="col-md-4">
                        <br><br>
                        <button id="paypal-button" class="btn pull-right" style="background: transparent;"></button>
                    </div>

                </div>
            </div>
        </div>
        
        
    <style>
        * {
            box-sizing: border-box;
        }

        .columns {
            float: left;
            width: 25%;
            padding: 2px;
        }

        .price {
            list-style-type: none;
            margin: 0;
            padding: 0;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }
        .price li {
            border: 1px solid white;
            padding: 2px;
            text-align: center;
        }

        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 25px;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
        }

        .sup {
            position: relative;
            bottom: 1ex;
            font-size: 65%;
        }
        .on-top {
            position: absolute;
            right: 20px;
            top: -20px;
            background-color: orange;
            line-height: 13px;
            max-width: 100px;
            padding: 5px 17px;
            text-align: center;
            -webkit-border-top-left-radius: 10px;
            -webkit-border-top-right-radius: 0;
            -webkit-border-bottom-right-radius: 10px;
            -webkit-border-bottom-left-radius: 10px;
        }


        .pricing-container {
            color: black; 
            display: flex;
            align-items: center;
            opacity: 0.6;
        }
        .pricing-container h1 {
            font-size: 50px;
            margin: 0 40px 0 0;
        }
        .pricing-container p {
            font-size: 20px;
        }
        .pricing-container p {
            margin: 0;
        }
        @media only screen and (max-width: 600px) {
            .columns {
                width: 100%;
            }
        }
    </style>
@endsection
@push('scripts')
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <script>
        <?php
        //SANDBOX Ab3qS8bdkcQ42CehKuhefbFDZd2zwfVWM_t-pEztB62WDCpDu1xd7H-6Tw47rXm4YyRz2nd96t989-6h
        //LIVE ATFXr48lzdkSM7rHKUml8XA-uPmGyZ7LG70LaYJMSaueLp1WnMmO9exhCprjpshJUpRfCrNs334J0rxO
        ?>
        paypal.Button.render({
            // env: 'sandbox',
            env: 'production',

            payment: function (resolve, reject) {
                return paypal.request.post('{{route('pp:create')}}', {
                    _token: window.Laravel.csrfToken,
                    amount: $('input[name=payment-amount]:checked').val()
                })
                    .then(function (data) {
                        resolve(data.paymentID);
                        return data.paymentID;
                    })
                    .catch(function (err) {
                        reject(err);
                    });
            },
            commit: true,
            // Optional: show a 'Pay Now' button in the checkout flow
            onAuthorize: function (data, actions) {

//                    return false;
                return paypal.request.post('{{route('pp:done')}}',
                    {paymentID: data.paymentID, payerID: data.payerID})
                    .then(function (data) {
                        window.location.href = '{{route('home')}}';
                    });
            }

        }, '#paypal-button');
    </script>
@endpush