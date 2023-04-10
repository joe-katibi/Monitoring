<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Role;
use App\Models\User;
use App\Models\UserCategory;
use App\Models\Services;
use App\Models\Positions;
use App\Models\Countries;
use App\Models\Categories;
use App\Models\Permission;
use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;



class UserController extends Controller
{
    use SendsPasswordResetEmails;
    protected $dateFormat = 'Y-m-d H : i : s';

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // $user = User::with(['department' => function ($query) {
        //             $query->select('id', 'department_name');
        //             }])
        //            ->join('countries','countries.id','=','users.country')
        //            ->join('services','services.id','=','users.services')
        //           // ->join('departments','departments.id','=','users.department_id')
        //             ->get();

        $user = User::select('users.id','users.name','users.email','users.country','users.services','users.category','users.user_status','users.created_at',
                             'users.position','services.service_name','countries.country_name','departments.department_name')
                            ->join('countries','countries.id','=','users.country')
                            ->join('services','services.id','=','users.services')
                            ->join('departments','departments.id','=','users.department_id')
                            //->join('roles','roles.id')
                          ->get();

                        //   if ($user->roles()) {
                        //     $user->roles = $user->roles()->get()->pluck('name');
                        // } else {
                        //     $user->roles = new Collection();
                        // }

           // print_pre($user ,true);



        $data['users'] = $user;


        // auth()->user()->givePermissionTo('view-bat');
        // auth()->user()->assignRole('Cashier');
       // print_pre($data['users']->toArray(),true);
        return view('settings.users.index')->with($data);


    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $roles = Role::all();
        $department = Departments::all();
        $service = Services::all();
        $country = Countries::all();
        $category = Categories::all();

        return view('settings.users.create', [
            'roles' => $roles,
            'department' => $department,
            'service' => $service,
            'country' => $country,
            'category' => $category,
            'user' => new User
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function store(Request $request)
    {

          $input = $request->all();

          //print_pre($input,true);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            //'category' => 'required',
            'email' => 'email|required|unique:users',
            'service' => 'required',
            'country' => 'required',
           // 'username' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->country = $request->input('country');
        $user->services = $request->input('service');
       // $user->category = json_encode($request->input('category'));
        $user->department_id = $request->input('department');
        $user->password = bcrypt(uniqid());

        $user->save();

        $roles = $request->input('roles');
        if (isset($roles)) {
            $user->syncRoles($roles);
        }
        foreach($request->input('category') as $key => $value){

            $category_user = new UserCategory();
            $category_user->user_id = $user->id;
           // $category_user->user_key =$key;
            $category_user->category_id = $value;
            $category_user->created_by = $request->input('created_by');

            $category_user->save();

        }

         //print_pre($category_user,true);



        /*   $response = $this->broker()->sendResetLink(
               $request->only('email')
           );*/
        /*
         * , function (Message $message) {
            $message->subject('Set your ' . config('app.name') . ' password');
        }
         */
       // $response = Password::sendResetLink(['email' => $request->input('email')]);

        return redirect()->back()->with([
            'message' => 'User added. Link has been sent to their email to set password',
            'message_type' => 'success'
        ]);
    }

    /**
     * Show the specified resource.
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function show()
    {
        return view('settings.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        /** @var User $user */
        $user = User::findOrFail($id);

        if ($user->roles()) {
            $user->roles = $user->roles()->get()->pluck('name');
        } else {
            $user->roles = new Collection();
        }

        $permissions = Permission::all();
        $department = Departments::all();
        $service = Services::all();
        $category = UserCategory::all();
        $country = Countries::all();
        return view('settings.users.edit', [
            'user' => $user,
            'department' => $department,
            'service' => $service,
            'country' => $country,
            'category' => UserCategory::all(),
            'roles' => Role::all(),
            'permission_modules' => Permission::modules(),
            'permissions' => $permissions,
            'user_permissions' => $user->permissions()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function update(Request $request, $id)
    {

        $input = $request->all();

        //print_pre($input ,true);

        $validator = Validator::make($request->all(), [
            'email' => 'email|required|unique:users,email,' . $id, ',id',
            'name' => 'required'
        ]);
        /** @var User $user */
        $user = User::findOrFail($id);


        if ($validator->fails()) {
            $data = $request->all();
            toast($validator->errors() , 'error')->position('top-end');
            return redirect()->back()->withInput(array_merge($user->toArray(), $data));
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->department_id = $request->input('department');
        $user->country = $request->input('country');
        $user->services = $request->input('service');

        $user->save();

        $roles = $request->input('roles');

        if ($roles == null) {
            $roles = [];
        }
        if (isset($roles)) {
            $user->syncRoles($roles);
        }

        $category = $request->input('category');

        foreach($category as $key => $value){

            $category_user = new UserCategory();

            $category_user->user_id = $id;
            $category_user->category_id = $value;
            $category_user->created_by =1;
            $category_user->save();

        }

        toast('User updated', 'success')->position('top-end');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserPermissions(Request $request, $id)
    {
        $module = $request->input('module');
        $sub_module = $request->input('sub_module');

        /** @var array $permissions */
        $permissions = $request->input('permissions');

        if ($permissions == null) {
            $permissions = [];
        }
        /** @var User $user */
        $user = User::find($id);

        /** @var Collection $current_permissions */
        $current_permissions = $user->permissions()->get();

        $delete_permissions = $current_permissions->filter(function ($permission) use ($module, $sub_module, $permissions) {
            return $permission->module == $module && $permission->sub_module == $sub_module &&
                !in_array($permission->name, $permissions);
        });

        $user->revokePermissionTo($delete_permissions);

        $user->givePermissionTo($permissions);

        return redirect('system/general/users/' . $user->id . '/edit')
            ->with([
                'message' => 'User Permissions Updated',
                'module' => $module,
                'sub_module' => $sub_module
            ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestPasswordReset(Request $request, $id)
    {

        $user = User::find($id);

        if (!$user->email) {
            return redirect('system/general/users/' . $id . '/edit')
                ->with([
                    'message' => 'The user does not have an email. Add an email to proceed.',
                    'message_type' => 'error'
                ]);
        }
        $response = Password::sendResetLink(['email' => $user->email]);

        return redirect('system/general/users/' . $id . '/edit')
            ->with([
                'message' => 'Password reset email sent to user.'
            ]);
    }

    public function activate($id)
    {
        /** @var User $user */
        $user = User::findOrFail($id);

        $user->user_status = 1;

        $user->save();

        return back();
    }

    public function deactivate($id)
    {
        /** @var User $user */

        $user = User::findOrFail($id);

        $user->user_status = 0;

        $user->save();

        return back();
    }

    public function online_users()
    {
        $data['users'] = User::all();
        return view('system::users.online_status')->with($data);
    }


    public function user_department()
    {
       $data['user'] = User::where('id' , '=' ,Auth::user()->id)->first();
       $data['departments'] = Department::all();
       return view('auth.department_check')->with($data);
    }

    public function user_department_save(Request $request, $id)
    {

        $input = $request->all();
        $user = user::find($id);
        $user->department = $input['department'];
        $user->update();
        return redirect('home');


    }

}
