<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


class Vote extends Model
{
    use SoftDeletes;

    protected $fillable = ['status'];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function votable()
    {
        return $this->morphTo();
    }
}