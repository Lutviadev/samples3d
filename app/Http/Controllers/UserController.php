<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Profile;
use App\Sandbox\Flash;
use App\User;
use Bican\Roles\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Datatables;

class UserController extends Controller
{

    /**
     * @var App\User
     */
    private $user;

    /**
     * Create a new instance.
     *
     */
    public function __construct(User $user)
    {
        $this->middleware('auth');

        $this->middleware('topusers');

        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Datatable listing of the resource.
     *
     * @return Datatable
     */
    public function dataTable()
    {
        $query = DB::select("SELECT users.id, users.username, users.email, roles.name as 'group'
                             FROM users, role_user, roles
                             WHERE users.id = role_user.user_id
                             AND roles.id = role_user.role_id AND users.deleted_at IS NULL
                             ORDER BY users.id DESC");

        $users = $this->user->hydrate($query);

        return Datatables::of($users)
            ->addColumn('action', function ($user){ return dataTableButtons('user', $user); })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $groups = withEmpty( Role::lists('name', 'id')->toArray() );
        return view('user.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->input();

        $data['password'] = bcrypt($data['password']);

        $profile = Profile::create($data);

        $user = $this->user->create($data);

        $user->attachRole($request->group);

        $user->profile()->save($profile);

        manageImages($user, $request->file('images'), $request->input('images'), 'create', 'storage/logos/', 'simple'); 

        Flash::success();

        return redirect(route('user_index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User
     * @return Response
     */
    public function edit(User $user)
    {
        $groups = Role::lists('name', 'id')->toArray();
        $usergroup = $user->role[0]->id;

        $images = $user->images;

        return view('user.edit', compact('user', 'groups', 'usergroup', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(User $user, UserRequest $request)
    {
        $user->username = $request->username;
        $user->email = $request->email;

        if($request->password != '')
        {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        $user->detachAllRoles();
        $user->attachRole($request->group);

        $user->profile->fill($request->input())->save();

        manageImages($user, $request->file('images'), $request->input('images'), 'edit', 'storage/logos/', 'simple');

        Flash::success();

        return redirect(route('user_index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(User $user)
    {
        if(Auth::user()->level() >= 999 || Auth::user()->can('delete.user') || Auth::user()->can('total.user'))
        {
            $user->delete();

            Flash::success();
        }
        else
        {
            Flash::danger();
        }

        return redirect(route('user_index'));
    }

}