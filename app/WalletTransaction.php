<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


class WalletTransaction extends Model
{
    use SoftDeletes;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(PayPalPayments::class);
    }

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }
}