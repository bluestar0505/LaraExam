<?php

namespace App\Providers;

use App\Answer;
use App\Domains;
use App\Observers\AnswerObserver;
use App\Observers\PaymentsObserver;
use App\Observers\WalletTransactionsObserver;
use App\PayPalPayments;
use App\WalletTransaction;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        WalletTransaction::observe(WalletTransactionsObserver::class);
        PayPalPayments::observe(PaymentsObserver::class);
        Answer::observe(AnswerObserver::class);
        
        //
        Validator::replacer('email_domain', function ($message, $attribute, $rule, $parameters) {
            return 'Due to privacy laws, you must have an email address from one of our universities.';
        });
        Validator::extend('email_domain', function($attribute, $value, $parameters, $validator) {
            $allowedEmailDomains = Domains::pluck('domain')->all();

            return in_array( explode('@', $value)[1] , $allowedEmailDomains);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        //
    }
}
