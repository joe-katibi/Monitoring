<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Services;
use App\Models\Countries;
use App\Models\Categories;
use App\Models\Permission;
use App\Models\Positions;
use Illuminate\Support\Facades\Hash;
use Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
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
        $data['users'] = User::select('users.id','users.name','users.email','users.country','users.services','users.category','users.user_status',
                                     'users.position','services.service_name','categories.category_name')
                                     ->join('services','services.id','=','users.services')
                                     ->join('categories','categories.id','=','users.category')
                                     ->where('is_admin','=', 0)
                                     ->get();

    //     $data['service'] = Services::select('services.id','services.service_name','services.service_id')
    //                                     ->join('users','users.services','=','services.service_id')
    //                                     ->get();

    //    $data['category'] = Categories::select('categories.id','categories.category_name','categories.service_id')
    //                                     ->join('users','users.category','=','categories.id')
    //                                     ->get();


        // $data['users'] = User::where('is_admin', 0)->latest()->paginate(200);
        // $data['roles']= Role::all();
                                        // dd($data);
                                        //  print_pre( [ $data], true);



        return view('admin/user',
        // [
        //     'users' => User::where('is_admin', 0)->latest()->paginate(200),
        //     'roles'=> Role::all()
        // ]
        )->with($data);

        // $user = User::where('is_admin', 0)->latest()->paginate(5);
        // $role = Role::where()->roles()->get();
        // return view('admin/user',compact('user','roles'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service = Services ::all()->toArray();
        $category = Categories ::all()->toArray();
        $roles = Role ::all()->toArray();
        $country = Countries ::all()->toArray();
        $position = Positions ::all()->toArray();
        return view('admin/Users/create',compact('service','category','roles','country','position'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $input = $request->all();

        // print_pre( [ $input], true);
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            $this->validate($request, [
                'name' => ['required', 'max:50'],
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
                'country' => ['required', 'max:50'],
                'services' => ['required', 'max:50'],
                'category' => ['required', 'max:50'],
                'position' => ['required', 'max:50'],
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'country' => $request->country,
                'services' => $request->services,
                'category' => $request->category,
                'position' => $request->position,
                'is_admin' => 0,
                'password' => Hash::make('password')
            ]);
            $role = Role::where('id', 5)->first();
            $user->syncRoles($role);
            return to_route('user');


        }
        return to_route('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id)
                          ->join('services','services.id','=','users.services')
                          ->join('categories','categories.id','=','users.category')
                          ->select('users.id','users.name','users.email','users.country','users.services','users.category','users.position','categories.category_name','services.service_name')
                          ->first();
        $permissions = $user->permissions()->get();
        $role = $user->roles()->get();
        $roles = Role::all();
        // $permission = $role->permissions()->get();
        $permission = Permission::all();

    // dd($user);

        return view('admin/Users/view',compact('user','role','permissions','roles','permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $user = User::where('id','=',$id)->first();
        $user = User::find($id);
        $permissions = $user->permissions()->get();
        $role = $user->roles()->get();
        $roles = Role::all();

        // var_dump($role->toArray());
        // exit();
        return view('admin/Users/edit',compact('user','role','permissions','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user,) {
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            $this->validate($request, [
                'name' => ['required', 'max:50'],
                'email' => ['required', 'string', 'email', 'max:50'],
            ]);
            if ($request->roles[0] === null) {
                return back()->withErrors(['roles' => 'The role field is required']);
            }
            if ($request->roles[0]['id'] != 5) {
                $adminRole = Role::where('id', $request->roles[0]['id'])->first();
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'is_admin' => 1,
                ]);
                $user->syncRoles($adminRole);
                return back();
            } else {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }
            return back();
        }
        return back();
    }
    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('message', 'Role exists.');
        }

        $user->assignRole($request->role);
        return back()->with('message', 'Role assigned.');
    }
    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role removed.');
        }

        return back()->with('message', 'Role not exists.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {

            $user->delete();







        //    if( $user->delete())
        //    {

        //     echo "toastsDefaultAutohide";
        //     // Log::alert("user Deleted");
        //     // Alert::success('User Deleted');
        // }
        //     else{

        //         echo "toastsDefaultAutohide2";


        //     }

        }

        return to_route('user');
    }
}
