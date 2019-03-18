<?php

namespace App;

use Carbon\Carbon;
use DB;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Laraveldaily\Quickadmin\Traits\AdminPermissionsTrait;
use Illuminate\Notifications\Notifiable;

class Notify extends Model
{
    protected $table = 'notify';
}
