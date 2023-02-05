<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Datatables;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class RoleController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    $this->middleware(['role:super-admin|admin|moderator']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $roles = Role ::all()->toArray();
       $permissions = Permission::all()->toArray();
        // $permissions = $roles->permissions()->get();
      return view('admin/roles',compact('roles','permissions'));




    }
      /**
     * Show the form for creating a new resource.
     *  'roles' => Role::with('permissions')->paginate(5),
    * 'permissions' => Permission::all(),
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role ::all()->toArray();
        $permissions = Permission::all()->toArray();
        return view('admin/role/create',compact('roles','permissions'));
    }
    public function edit($id)
    {
        //
        // $permissions = Permission::all();
        // $role = Role::all();
        //   return view('admin/role/edit',compact('role','permissions'));


        $role = Role::find($id);
        $permissions = $role->permissions()->get();
        $permission = Permission::all();
        return view('admin/role/edit',compact('role','permissions','permission'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            $this->validate($request, [
                'name' => ['required', 'max:25', 'unique:roles'],
                'permissions' => 'required'
            ]);
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);
            if ($request->has('permissions')) {
                $role->givePermissionTo(collect($request->permissions)->pluck('id')->toArray());
            }

            // return to_route('roles');

            toast('Success Toast','success');

            Alert::success('Success', 'Role Created with permissions');

        }
        return to_route('roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role) {
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            $this->validate($request, [
                'name' => ['required', 'max:25'],
                'permissions' => 'required'
            ]);
            if ($request->has('permissions')) {
                $role->givePermissionTo(collect($request->permissions)->pluck('id')->toArray());
            }
            $role->syncPermissions(collect($request->permissions)->pluck('id')->toArray());
            $role->update(['name' => $request->name]);
            return back();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role) {
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {

            return to_route('role');
        }
        $role->delete();
        return to_route('role');
    }
    public function givePermission(Request $request,Role $role)
    {
        if($role->hasPermissionTo($request->permissions)){
            return back();

        }else{
            $role->givePermissionTo($request->permissions);
            return back();
          }
    }
    public function revokePermission(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission not exists.');
    }
}
