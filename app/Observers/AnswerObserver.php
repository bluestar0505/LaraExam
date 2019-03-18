<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 17.01.2018
 * Time: 12:39
 */

namespace App\Observers;


use App\Answer;
use App\PayPalPayments;
use DB;

class AnswerObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  Answer $answer
     * @return void
     */
    public function created(Answer $answer)
    {
        if ($answer->question_id) {
            $question = $answer->question()->first();
        } else {
            $parentAnswer = $answer->parent()->first();
            $question = $parentAnswer->question()->first();
        }

        $users = $question->subscribers()->get();
        $users = $users->keyBy('id');
        $users->forget($answer->user_id);

        if ($users->isNotEmpty()) {

            $id = DB::table('notify')->insertGetId(
                array('notify_text' =>
                    'New answer on '
                    . '<a href="' . route('paper.qa.view', $question->id) . '">' . str_limit($question->title, 50, '...') . '</a>'
                )
            );

            foreach ($users as $user) {

                DB::table('notification_users')->insert([
                    ['notification_id' => $id, 'UserID' => $user->id, 'IsSeen' => 0]
                ]);

            }

        }

    }
}