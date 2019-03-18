<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Translations;
use App\Http\Requests\CreateTranslationsRequest;
use App\Http\Requests\UpdateTranslationsRequest;
use Illuminate\Http\Request;


class TranslationsController extends Controller
{

    /**
     * Display a listing of translations
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $translations = Translations::all();

        return view('admin.translations.index', compact('translations'));
    }

    /**
     * Show the form for creating a new translations
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        return view('admin.translations.create');
    }

    /**
     * Store a newly created translations in storage.
     *
     * @param CreateTranslationsRequest|Request $request
     */
    public function store(CreateTranslationsRequest $request)
    {

        Translations::create($request->all());

        return redirect()->route(config('quickadmin.route') . '.translations.index');
    }

    /**
     * Show the form for editing the specified translations.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $translations = Translations::find($id);


        return view('admin.translations.edit', compact('translations'));
    }

    /**
     * Update the specified translations in storage.
     * @param UpdateTranslationsRequest|Request $request
     *
     * @param  int $id
     */
    public function update($id, UpdateTranslationsRequest $request)
    {
        $translations = Translations::findOrFail($id);


        $translations->update($request->all());

        return redirect()->route(config('quickadmin.route') . '.translations.index');
    }

    /**
     * Remove the specified translations from storage.
     *
     * @param  int $id
     */
    public function destroy($id)
    {
        Translations::destroy($id);

        return redirect()->route(config('quickadmin.route') . '.translations.index');
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
            Translations::destroy($toDelete);
        } else {
            Translations::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route') . '.translations.index');
    }

}
