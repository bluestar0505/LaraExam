<?php

namespace App\Http\Controllers;

use App\Paper;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaperCtrl extends Controller
{
    public function show($id)
    {

        User::updateActivity();
        $boughtPapersIds = \Auth::user()->bought()->pluck('paper_id');
        if (!$boughtPapersIds->contains($id)) {
            return redirect()->back();
        }

        $paper = Paper::getPaper($id);

        if (!$paper) return redirect()->back();
        $favoritesPapersIds = \Auth::user()->favorites()->pluck('paper_id');

        // we mark the paper as seen by user, without having duplicates
        $update = DB::table('user_paper_lastviewed')
            ->where([
                ['user_id', '=', \Auth::user()->id],
                ['paper_id', '=', $id],
            ])
            ->update(['created_at' => date('Y-m-d H:i:s')]);

        if(!$update)
            \Auth::user()->papersViewed()->attach($id);


        return view('web.paper', compact('paper', 'favoritesPapersIds'));
    }

    public function showQA($id)
    {

        $paper = Paper::find($id);
        if (!$paper) return redirect()->back();

        $questions = $paper->questions()->get();


        return view('web.paperQA', compact('paper', 'questions'));
    }


    public function QuestionDetail($id)
    {
        $paper = Paper::getPaper($id);

        return view('web.QuestionDetail', compact('paper'));
    }

    public function AskQuestion($id)
    {
        $paper = Paper::getPaper($id);

        return view('web.AskQuestion', compact('paper'));
    }
}
