<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


class Paper extends Model
{

    protected $fillable = [
        'name',
        'text',
        'price',
        'category_id',
        'active'
    ];


    public static function boot()
    {
        parent::boot();

        Paper::observe(new UserActionsObserver);
    }

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }


    public static function getPaper($id)
    {
        return Paper::where('id', $id)->where('active', 1)->first();
    }

    public static function inCategory($category_id)
    {
        return Paper::where('category_id', $category_id)->where('active', 1)->get();
    }

    public static function search($string)
    {
        return Paper::where('name', 'LIKE', '%' . $string . '%')->where('active', 1)->get();
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'wallet_transactions', 'paper_id', 'user_id');
    }

    public function likes()
    {
        return $this->likings(1);
    }

    public function dislikes()
    {
        return $this->likings(0);
    }

    /**
     * @param $choice
     *
     * Returns the number of likings/dislikings depending on the value used
     * - 0 for dislikes
     * - 1 for likes
     *
     * @return int
     */
    protected function likings($choice)
    {
        return DB::table('paper_likings')->where([
            'paper_id' => $this->id,
            'choice' => $choice,
        ])->count();
    }

    /**
     *  Returns if a user likes/dislikes, did not set any liking preferences
     *
     * @return mixed
     */

    public function userLikingStatus()
    {
        if($user = Auth::user()){
            $result = DB::table('paper_likings')->where([
                'paper_id' => $this->id,
                'user_id' => Auth::user()->id,
            ])->select('choice')->first();

            if($result)
                return $result->choice;


            return null;
        }

        return null;
    }
}