<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Domains;
use App\Http\Requests\CreateDomainsRequest;
use App\Http\Requests\UpdateDomainsRequest;
use Illuminate\Http\Request;



class DomainsController extends Controller {

	/**
	 * Display a listing of domains
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $domains = Domains::all();

		return view('admin.domains.index', compact('domains'));
	}

	/**
	 * Show the form for creating a new domains
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.domains.create');
	}

	/**
	 * Store a newly created domains in storage.
	 *
     * @param CreateDomainsRequest|Request $request
	 */
	public function store(CreateDomainsRequest $request)
	{
	    
		Domains::create($request->all());

		return redirect()->route(config('quickadmin.route').'.domains.index');
	}

	/**
	 * Show the form for editing the specified domains.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$domains = Domains::find($id);
	    
	    
		return view('admin.domains.edit', compact('domains'));
	}

	/**
	 * Update the specified domains in storage.
     * @param UpdateDomainsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateDomainsRequest $request)
	{
		$domains = Domains::findOrFail($id);

        

		$domains->update($request->all());

		return redirect()->route(config('quickadmin.route').'.domains.index');
	}

	/**
	 * Remove the specified domains from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Domains::destroy($id);

		return redirect()->route(config('quickadmin.route').'.domains.index');
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
            Domains::destroy($toDelete);
        } else {
            Domains::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.domains.index');
    }

}
