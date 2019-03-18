<?php

namespace App;

use App\Traits\Votable;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Votable;
    protected $fillable = [
        'title',
        'question',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'question_user_notifications');
    }
}
