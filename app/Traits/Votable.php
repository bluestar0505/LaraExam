<?php

namespace App\Traits;

use App\User;
use App\Vote;
use Auth;

trait Votable
{

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function checkIfVoted(User $user)
    {
        return $this->votes()->where('user_id', $user->id)->exists();
    }

    public function getVote(User $user)
    {
        return $this->votes()->where('user_id', $user->id)->first();
    }

    public function recountPoints()
    {
        $points = 0;
        foreach ($this->votes()->get() AS $vote) {
            if ($vote->status == 'upvote')
                $points = $points + 1;
            elseif ($vote->status == 'downvote')
                $points = $points - 1;
        }
        $this->points = $points;
        $this->save();
        return $points;
    }

    public function vote($status)
    {
        if (Auth::user() != null) {
            $user = Auth::user();
            if (!$this->checkIfVoted($user)) {
                $vote = new Vote();
                $vote->user_id = Auth::user()->id;
                $vote->status = $status;
                $this->votes()->save($vote);
                return true;
            } else {
                $vote = $this->getVote($user);
                $vote->status = $status;
                $vote->save();
                return true;
            }
        }
        return false;
    }
}