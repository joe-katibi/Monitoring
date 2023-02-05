<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Datatables; 
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
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
        $permissions = Permission::all();
       // $roles = Role ::all()->toArray();  
       return view('admin/permissions',compact('permissions'));
        
        
        // return view('admin/permissions', [
        //     'permissions' => Permission::with('roles')->paginate(1000),
        //     'roles' => Role::all(),
        // ]);
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all()->toArray();
        //$roles = Role ::all()->toArray(); 
        return view('admin/permission/create',compact('permissions'));
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => ['required', 'max:25', 'unique:permissions'],
            'description' => ['required', 'max:25'],
        ]);
        Permission::create([
            'name' => $request->name,
            'description' => $request->description,
            'guard_name' => 'web',
        ]);
        return to_route('permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission) {
        $this->validate($request, [
            'name' => ['required', 'max:25'],
            'description' => ['required', 'max:25'],
        ]);
        $permission->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return to_route('permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission) {
        $permission->delete();
        return to_route('permissions');
    }
}
