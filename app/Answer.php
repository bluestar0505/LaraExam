<?php

namespace App;

use App\Traits\Votable;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use Votable;

    protected $fillable = [
        'user_id',
        'question_id',
        'parent_answer_id',
        'answer',
    ];
    public function childs()
    {
        return $this->hasMany(Answer::class, 'parent_answer_id');
    }

    public function parent()
    {
        return $this->belongsTo(Answer::class, 'parent_answer_id');

    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
