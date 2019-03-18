<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Domains extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'domains';
    
    protected $fillable = ['domain'];
    

    public static function boot()
    {
        parent::boot();

        Domains::observe(new UserActionsObserver);
    }
    
    
    
    
}