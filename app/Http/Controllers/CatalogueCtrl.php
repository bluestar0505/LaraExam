<?php

namespace App\Http\Controllers;

use App\Category;
use App\Domains;
use App\Paper;
use App\Repositories\TransactionsRepository;
use App\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class CatalogueCtrl extends Controller
{

    public function index()
    {
        $domain = Domains::where('domain', substr(strrchr(Auth::user()->email, "@"), 1))
            ->first();

        $categories = Category::where('visible', 1)
            ->where('parent_id', 0)
            ->where('domain_id', isset($domain) ? $domain->id : '0')
            ->orderBy('name')
            ->orderBy('order', 'desc')
            ->get()
            ->load(['papers', 'child', 'child.papers']);
            
        $boughtPapersIds = \Auth::user()->bought()->pluck('paper_id');
        return view('web.catalogue', compact('categories', 'boughtPapersIds'));

    }

    public function buyPaper(Request $request)
    {
        $this->validate($request, [
            'paper_id' => 'required|exists:papers,id'
        ]);
        $paper = Paper::find($request->input('paper_id'));
        $result = (new TransactionsRepository())->buyPaper(\Auth::user(), $paper);
        if ($result) {
            return back()->with(['success' => 'Paper bought']);
        } else {
            return back()->withErrors(['Something going wrong!']);
        }
    }

    public function xhrBuyPaper(Request $request)
    {
        $this->validate($request, [
            'paper_id' => 'required|exists:papers,id'
        ]);
        $paper = Paper::find($request->input('paper_id'));
        $result = (new TransactionsRepository())->buyPaper(\Auth::user(), $paper);
        if ($result) {
            return response()->json([
                'success' => true,
                'msg' => 'Paper bought',
                'paper_id' => $paper->id,
                'paper_name' => $paper->name,
                'paper_price' => isset($paper->price) ? (int)$paper->price : 1
            ]);
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Error',
                'paper_id' => null
            ]);
        }
    }

    public function favorites()
    {

        $user = \Auth::user();
        $categories = Category::orderBy('name')->with('papers')->get();
        $boughtPapers = $user->bought()->get();
        $boughtPapersIds = $boughtPapers->pluck('id');

        //FILTER bought papers

        $categories = $categories->toArray();
        foreach ($categories as $catKey => $cat) {
            foreach ($cat['papers'] as $paperKey => $paper) {
                if (!$boughtPapersIds->contains($paper['id'])) {
                    unset($categories[$catKey]['papers'][$paperKey]);
                }
            }
            if (empty($categories[$catKey]['papers'])) {
                unset($categories[$catKey]);
            }
        }


        $favoritesPapersIds = $user->favorites()->pluck('paper_id');
        //FILTER FAVORITES PAPERS
        $categoriesFavorite = $categories;
        foreach ($categoriesFavorite as $catKey => $cat) {
            foreach ($cat['papers'] as $paperKey => $paper) {
                if (!$favoritesPapersIds->contains($paper['id'])) {
                    unset($categoriesFavorite[$catKey]['papers'][$paperKey]);
                }
            }
            if (empty($categoriesFavorite[$catKey]['papers'])) {
                unset($categoriesFavorite[$catKey]);
            }
        }

        $lastViewed = \Auth::user()->papersViewed()
            ->orderBy('user_paper_lastviewed.created_at', 'desc')
            ->limit(5)->get();


        return view('web.favorites',
            compact('categories', 'categoriesFavorite',
                'favoritesPapersIds', 'lastViewed')
        );
    }

    public function like($id)
    {
        $paper = Paper::getPaper($id);

        if(!$paper)
            abort(404);

        $likingStatus = $paper->userLikingStatus();

        if($likingStatus === 0){
            DB::table('paper_likings')->where([
                    'user_id' => Auth::user()->id,
                    'paper_id' => $id,
                    'choice' => 0
                ])->update(['choice' => 1]);
        } elseif ($likingStatus === null){
            DB::table('paper_likings')->insert([
                    'user_id' => Auth::user()->id,
                    'paper_id' => $id,
                    'choice' => 1
                ]);
        }

        return back();
    }

    public function dislike($id)
    {

        $paper = Paper::getPaper($id);

        if(!$paper)
            abort(404);

        $likingStatus = $paper->userLikingStatus();

        if($likingStatus === 1){
            DB::table('paper_likings')->where([
                'user_id' => Auth::user()->id,
                'paper_id' => $id,
                'choice' => 1
            ])->update(['choice' => 0]);
        } elseif ($likingStatus === null){
            DB::table('paper_likings')->insert([
                'user_id' => Auth::user()->id,
                'paper_id' => $id,
                'choice' => 0
            ]);
        }

        return back();
    }


    /**
     * Deletes the like entry if it exists
     *
     * @param $id
     */
    public function unlike($id)
    {

        $paper = Paper::getPaper($id);

        if(!$paper)
            abort(404);

        $likingStatus = $paper->userLikingStatus();

        if($likingStatus === 1)
            DB::table('paper_likings')->where([
                'user_id' => Auth::user()->id,
                'paper_id' => $id,
                'choice' => 1])
                ->delete();

        return back();
    }

    /**
     * Deletes the dislike entry if it exists
     *
     * @param $id
     */
    public function undislike($id)
    {

        $paper = Paper::getPaper($id);

        if(!$paper)
            abort(404);

        $likingStatus = $paper->userLikingStatus();

        if($likingStatus === 0)
            DB::table('paper_likings')->where([
                'user_id' => Auth::user()->id,
                'paper_id' => $id,
                'choice' => 0])
                ->delete();

        return back();
    }

    public function favToggle(Request $request)
    {
        $this->validate($request, [
            'paper_id' => 'required|exists:papers,id'
        ]);
        $paper = Paper::find($request->input('paper_id'));

        $user = \Auth::user();
        $result = $user->favorites()->toggle($paper);
        if ($result) {
            return back()->with(['success' => 'Paper added to favorites']);
        } else {
            return back()->withErrors('Error');
        }
    }
}
