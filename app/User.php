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

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, AdminPermissionsTrait, Notifiable;

    const REDIRECT_TO = '/paypal';
    const LOGIN_REDIRECT_TO = '/catalogue';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role_id', 'DefaultTab'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public static function boot()
    {
        parent::boot();

        User::observe(new UserActionsObserver);
    }

    public function redirectTo()
    {
        $url = '/catalogue';

        if($this->bought()->count())
            $url = '/favorites';

        return $url;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function payPalPayments()
    {
        return $this->hasMany(PayPalPayments::class);
    }

    public static function isAdmin()
    {
        return Auth::check() && Auth::user()->role_id > 0;
    }

    public static function updateActivity()
    {
        if (Auth::check()) {
            Auth::user()->touch();
            return true;
        } else {
            return false;
        }
    }

    public static function activity()
    {

        $periods = [
            '24 hours' => Carbon::now()->subDay(),
            '7 days' => Carbon::now()->subDays(7),
            '2 weeks' => Carbon::now()->subDays(14),
            '1 month' => Carbon::now()->subMonth(),
        ];

        $activity = [];

        foreach ($periods as $k => $v) {
            $activity[$k] = User::where('created_at', '>=', $v)->orWhere('updated_at', '>=', $v)->count();
        }

        return $activity;
    }

    public function favorites()
    {
        return $this->belongsToMany(Paper::class, 'paper_user_favorites');
    }

    public function bought()
    {
        return $this->belongsToMany(Paper::class, 'wallet_transactions', 'user_id', 'paper_id');
    }

    public function walletTransactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function walletUpdate()
    {
        $sum = WalletTransaction::where('user_id', $this->id)->select(DB::raw('SUM(amount) as wallet_amount'))->first();

        $this->wallet = $sum['wallet_amount'];
        $this->save();
        return true;

    }

    public function walletCounted()
    {
        $sum = WalletTransaction::where('user_id', $this->id)->select(DB::raw('SUM(amount) as wallet_amount'))->first();

        return (float)$sum['wallet_amount'];
    }

    public function subscribe()
    {
        return $this->belongsToMany(Question::class, 'question_user_notifications');
    }

    public function notificat()
    {
        return $this->belongsToMany(Notify::class, 'notification_users', 'UserID', 'notification_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Scope a query to only include admin users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdmin($query)
    {
        return $query->where('role_id', '=', 1);
    }

    public function papersViewed()
    {
        return $this->belongsToMany(Paper::class, 'user_paper_lastviewed')
            ->withTimestamps();
    }
}
