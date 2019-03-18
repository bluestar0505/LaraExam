<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Paper;
use App\Http\Requests\CreatePapersRequest;
use App\Http\Requests\UpdatePapersRequest;
use Illuminate\Http\Request;

use App\Category;


class PapersController extends Controller
{

    /**
     * Display a listing of papers
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $papers = Paper::with("category")->get();
        return view('admin.papers.index', compact('papers'));
    }

    /**
     * Show the form for creating a new papers
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $category = Category::pluck("name", "id");


        return view('admin.papers.create', compact("category"));
    }

    /**
     * Store a newly created papers in storage.
     *
     * @param CreatePapersRequest|Request $request
     */
    public function store(CreatePapersRequest $request)
    {

        Paper::create($request->all());

        return redirect()->route(config('quickadmin.route') . '.papers.index');
    }

    /**
     * Show the form for editing the specified papers.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $papers = Paper::find($id);
        $category = Category::pluck("name", "id");


        return view('admin.papers.edit', compact('papers', "category"));
    }

    /**
     * Update the specified papers in storage.
     * @param UpdatePapersRequest|Request $request
     *
     * @param  int $id
     */
    public function update($id, UpdatePapersRequest $request)
    {
        $papers = Paper::findOrFail($id);


        $papers->update($request->all());

        return redirect()->route(config('quickadmin.route') . '.papers.index');
    }

    /**
     * Remove the specified papers from storage.
     *
     * @param  int $id
     */
    public function destroy($id)
    {
        Paper::destroy($id);

        return redirect()->route(config('quickadmin.route') . '.papers.index');
    }

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Paper::destroy($toDelete);
        } else {
            Paper::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route') . '.papers.index');
    }

}
