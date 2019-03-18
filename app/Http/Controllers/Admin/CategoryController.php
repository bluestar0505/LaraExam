<?php

namespace App\Http\Controllers\Admin;

use App\Domains;
use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

use App\User;


class CategoryController extends Controller
{

    /**
     * Display a listing of category
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $category = Category::with("parent", "domain")->get();

        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new category
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $parent = Category::pluckParent();
        $domains = Domains::all()->pluck("domain", "id");

        return view('admin.category.create', compact("parent", "domains"));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param CreateCategoryRequest|Request $request
     */
    public function store(CreateCategoryRequest $request)
    {
        $this->validate($request, ['order' => 'required']);
        $request->merge(['visible' => $request->has('visible') ? 1 : 0]);
        Category::create($request->all());

        return redirect()->route(config('quickadmin.route') . '.category.index');
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $parent = Category::pluckParent($id);
        $domains = Domains::all()->pluck("domain", "id");

        return view('admin.category.edit', compact('category', "parent", "domains"));
    }

    /**
     * Update the specified category in storage.
     * @param UpdateCategoryRequest|Request $request
     *
     * @param  int $id
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route(config('quickadmin.route') . '.category.index');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int $id
     */
    public function destroy($id)
    {
        Category::destroy($id);

        return redirect()->route(config('quickadmin.route') . '.category.index');
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
            Category::destroy($toDelete);
        } else {
            Category::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route') . '.category.index');
    }

}
