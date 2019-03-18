<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Support\Facades\Hash; 


class ManageUsers extends Model {


    protected $table    = 'users';
    
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
        'paid',
        'email_verified'
    ];
    

    public static function boot()
    {
        parent::boot();

        ManageUsers::observe(new UserActionsObserver);
    }
    
    public function role()
    {
//        return $this->hasOne('App\Role', 'id', 'role_id');
        return $this->belongsTo(Role::class);
    }


    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        $this->attributes['password'] = Hash::make($input);
    }

    public function payments()
    {
        return $this->hasMany('App\PayPalPayments', 'user_id', 'id');
    }

    public function amountSpent()
    {
        return DB::table('paypal_payments')
            ->where('user_id', '=', $this->id)
            ->where('state', '=', 'approved')
            ->sum('amount');
    }
}