<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayPalPayments extends Model
{
    use SoftDeletes;

    protected $table = 'paypal_payments';
    protected $fillable = [
        'user_id',
        'paypal_id',
        'amount',
        'currency',
        'state',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
