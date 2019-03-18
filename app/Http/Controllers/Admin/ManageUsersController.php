<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Paper;
use App\User;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Schema;
use App\ManageUsers;
use App\Http\Requests\CreateManageUsersRequest;
use App\Http\Requests\UpdateManageUsersRequest;
use Illuminate\Http\Request;

use App\Role;


class ManageUsersController extends Controller
{

    /**
     * Display a listing of manageusers
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $manageusers = ManageUsers::with("role", "payments")
            ->where('role_id', '!=', config('quickadmin.defaultRole'))
            ->orderBy('id', 'DESC')->get();

        return view('admin.manageusers.index', compact('manageusers', 'papers'));
    }

    /**
     * Show the form for creating a new manageusers
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $role = $this->getRoles();

        return view('admin.manageusers.create', compact("role"));
    }

    /**
     * Store a newly created manageusers in storage.
     *
     * @param CreateManageUsersRequest|Request $request
     */
    public function store(CreateManageUsersRequest $request)
    {

        ManageUsers::create(array_merge($request->all(), ['email_verified' => 1]));

        return redirect()->route(config('quickadmin.route') . '.manageusers.index');
    }

    /**
     * Show the form for editing the specified manageusers.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $manageusers = ManageUsers::find($id);

        $role = $this->getRoles();
        $paid = '{"0":"No","1":"Yes"}';

        if ($manageusers->role_id != config('quickadmin.defaultRole')) {
            $user = User::find($id);
            $boughtPapers = $user->bought()->get();
            $boughtPapersIds = $boughtPapers->pluck('id');

            $papers = Paper::where('active', 1)->whereNotIn('id', $boughtPapersIds)->orderBy('name')->get();

            return view('admin.manageusers.edit', compact('manageusers', "role", "paid", 'papers'));
        }

        // return to list
        return redirect()->route(config('quickadmin.route') . '.manageusers.index');
    }

    /**
     * Update the specified manageusers in storage.
     * @param UpdateManageUsersRequest|Request $request
     *
     * @param  int $id
     */
    public function update($id, UpdateManageUsersRequest $request)
    {
        $manageusers = ManageUsers::findOrFail($id);

        if ($manageusers->role_id != config('quickadmin.defaultRole')) {

            $input = $request->all();
            if ($request->has('password') && !empty(trim($input['password']))) {
                $input['password'] = Hash::make($input['password']);
            } else {
                unset($input['password']);
            }

            $manageusers->update($input);

        }

        return redirect()->route(config('quickadmin.route') . '.manageusers.index');
    }

    /**
     * Remove the specified manageusers from storage.
     *
     * @param  int $id
     */
    public function destroy($id)
    {

        $manageusers = ManageUsers::find($id);

        if ($manageusers->role_id != config('quickadmin.defaultRole')) {
            ManageUsers::destroy($id);
        }

        return redirect()->route(config('quickadmin.route') . '.manageusers.index');
    }


    private function getRoles()
    {

        $roles = Role::where('id', '!=', config('quickadmin.defaultRole'))->get();
        $role = $roles->pluck("title", "id")->prepend('User', 0);

        return $role;
    }
}
