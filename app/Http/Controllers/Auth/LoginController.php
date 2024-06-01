<?php

namespace App\Http\Controllers\Auth;

use App\adLDAP;
use App\adLDAPVendor;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   //use AuthenticatesUsers;

    public function showLoginForm()
    {


        return view('auth.login');
    }

    public function authenticateUser(Request $request)
    {
        $username = strtolower($request->input('username'));
        $password = $request->input('password');
        $domain = $request->input('domain');

        if ($domain == 1) {
            $adldap = new adLDAP();
        } else {
            $adldap = new adLDAPVendor();
        }


        $authUser = $adldap->authenticate($username, $password);

        if ($authUser == true) {
            $userinfo = $adldap->user_info($username, array("name", "samaccountname", "userPrincipalName", "mail",));

            foreach ($userinfo as $key => $value) {
                $userinfo = $value;
            }

            $name = $userinfo['name'][0];
            $username = $userinfo['samaccountname'][0];


            $name = $userinfo['name'][0];
            $username = strtolower($userinfo['samaccountname'][0]);
            $email = $userinfo['mail'][0];

            $user_names =  User::select('username')->pluck('username')->toArray();


            if (in_array($username, $user_names)) {
                $credentials = $request->only('username', 'password');
                DB::table('users')->where(array('username' => $username))->update(array(
                    'password' => Hash::make($password)
                ));


                if (Auth::attempt($credentials)) {

                    return redirect('/home');
                }
            } else {
                $user = new User();
                $user->name = ucwords($name);
                $user->email = $email;
                $user->username = $username;
                $user->password = Hash::make($password);
                $user->save();

                $credentials = $request->only(
                    'username',
                    'password'
                );

                if (Auth::attempt($credentials, $request->has('remember'))) {
                    return redirect('/auth/notActivated');
                } else {
                }
            }
        } else {
            return back()->with('error', 'Incorrect username or password');
        }
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     protected function authenticated(Request $request, $user)
     {
         if ($user->user_status == 0) {
             // Redirect to the not activated view
             return redirect()->route('notActivated');
        }

         // Store the activation status in the session
       Session::put('user_status', $user->user_status);

         return redirect()->intended($this->redirectPath());
     }
}
