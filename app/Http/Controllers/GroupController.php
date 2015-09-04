<?php

namespace App\Http\Controllers;

use App\Briefcase;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\GroupRequest;
use App\Sandbox\Flash;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Datatables;
use Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Input;
use Redirect;

class GroupController extends Controller
{
    /**
     * @var App\Role
     */
    private $role;

    /**
     * Create a new instance.
     *
     */
    public function __construct(Role $role)
    {
        $this->middleware('auth');

        $this->middleware('topusers');

        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        removeSession('group');

        return view('group.index');
    }

    /**
     * Datatable listing of the resource.
     *
     * @return Datatable
     */
    public function dataTable()
    {
        $groups = $this->role->select(['id','name','description'])->orderBy('id', 'desc');

        return Datatables::of($groups)
            ->addColumn('action', function ($group){ return dataTableButtons('group', $group); })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $briefcases = Briefcase::lists('name','id')->toArray();

        return view('group.create', compact('briefcases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(GroupRequest $request)
    {
        $group = $this->role->create($request->input());

        $group->briefcases()->attach($request->briefcases);

        Self::managePermissions( $group, $request->briefcases, $request->permissions );

        removeSession('group');

        Flash::success();

        return redirect(route('group_index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Bican\Roles\Models\Role
     * @return Response
     */
    public function edit(Role $group)
    {
        $briefcases = Briefcase::lists('name','id')->toArray();

        $permissions = $group->permissions;

        return view('group.edit', compact('group', 'permissions', 'briefcases'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Role $group, GroupRequest $request)
    {     
        $group->fill($request->input())->save(); 

        $group->briefcases()->sync($request->briefcases);  

        Self::managePermissions($group, $request->briefcases, $request->permissions, 'update');
        
        removeSession('group');

        Flash::success();

        return redirect(route('group_index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Role $group)
    {        
        if(Auth::user()->level() >= 999 || Auth::user()->can('delete.group') || Auth::user()->can('total.group'))
        {            
            $group->detachAllPermissions();

            $group->delete();

            Flash::success();
        }
        else
        {
            Flash::danger();            
        }

        return redirect(route('group_index'));
    }

    /**
     * Create and attach permissions for each briefcases.
     *
     * @param  \Bican\Roles\Models\Role $role
     * @param  array $briefcases
     * @param  array $permissions
     * @param  string $method
     */
    private static function managePermissions(Role $group, $briefcases, $permissions, $method = 'create')
    {   
        if($method == 'update') 
        {
            $group->permissions()->delete();
            $group->detachAllPermissions(); 
        }

        foreach ($briefcases as $key => $value)
        {
            foreach ($permissions[$value] as $keyp => $valuep)
            {                  
                $group->attachPermission( Permission::create( Self::parseData($valuep, $value) ) );     
            }
        }  
    } 

    /**
     * Parse permissions data.
     *
     * @param  string   $briefcasesdata
     * @param  int      $permissionsdata
     * @return array
     */
    private static function parseData($briefcasesdata, $permissionsdata)
    {
        $nameparts = explode('.', $briefcasesdata);

        $name = ucfirst($nameparts[0]).' '.ucfirst($nameparts[1]); 

        $slug = $briefcasesdata;

        $description = $permissionsdata; 

        switch ($nameparts[1]) 
        {
            case 'animation': $model = 'App\Animation'; break;
            case 'render':    $model = 'App\Render';    break;
            case 'tour':      $model = 'App\Tour';      break;
            case 'portfolio': $model = 'App\Porfolio';  break;
            default:          $model = NULL;            break;
        }

        return  $parsedata = [
                    'name'          =>    $name,
                    'slug'          =>    $slug,
                    'description'   =>    $description,
                    'model'         =>    $model
                ];  
    }         

}